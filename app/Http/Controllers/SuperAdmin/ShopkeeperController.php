<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shopkeeper;
use Illuminate\Support\Facades\Hash;
use PDF;

class ShopkeeperController extends Controller
{
    public function index()
    {
    $query = Shopkeeper::query();
    if (request('term')) {
    $term = request('term');
    $query->where('name', 'Like', '%' . $term . '%')
    ->orWhere('email', 'Like', '%' . $term . '%');
    }
    $shopkeepers = $query->orderBy('id', 'DESC')->paginate(15);
    return view('superadmin.shopkeeper.index', compact('shopkeepers'));
    }

    public function create()
    {
    return view('superadmin.shopkeeper.create');
    }
    
    public function store(Request $request)
    {
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'email' => 'required|string|email|max:80|unique:users',
    'password' => 'required|string|min:8|confirmed',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    'status'=>'required|notIn:2',
]);
    
    //upload selected image
    $imageName = '';
    if (isset($request->profilePic)) {
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    
    // store staff
    $user = Shopkeeper::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
    
    return redirect()->route('superadmins.shopkeepers.index')->with(['shopkeeper-saved'=>'Record successfully Saved!']);
    }
    
    public function show($id)
    {
    return redirect()->route('superadmins.shopkeepers.index');
    }
    
    public function edit($id)
    {
    $shopkeeper = Shopkeeper::findOrFail($id);
    return view('superadmin.shopkeeper.edit', compact('shopkeeper'));
    }
    
    public function update(Request $request, $id)
    {
    $shopkeeper = Shopkeeper::findOrFail($id);
    
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'password' => $request->password ? 'nullable|string|min:8|max:255|confirmed' : '',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    'status'=>'required|notIn:2',
    ]);
    
    $imageName = $shopkeeper->profile_picture;
    
    // remove current image and upload new image
    if (isset($request->profilePic)) {
    $this->deleteImage('img/profile/' . $shopkeeper->profile_picture);
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    
    $request->password ? $password = Hash::make($request->password) : $password = $shopkeeper->password;
    
    // update user
    $shopkeeper->update([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $password,
    'profile_picture' => $imageName,
    'role' => $request->accountType,
    'status' => $request->status,
    ]);
    
    return redirect()->route('superadmins.shopkeepers.index')->with(['shopkeeper-updated'=>'Record successfully Updated!']);
    }
    
    public function destroy($id)
    {
    $user = Shopkeeper::findOrFail($id);
    
    // delete user image from storage
    $this->deleteImage('img/profile/' . $user->profile_picture);
    
    // delete user
    $user->delete();
    return redirect()->route('superadmins.shopkeepers.index')->with(['shopkeeper-deleted'=>'Record successfully Deleted']);
    }

    public function changeStatus($id)
    {
    $shopkeeper = Shopkeeper::findOrFail($id);
    // change staff status
    if ($shopkeeper->status == 1) {
    $shopkeeper->update([
    'status' => 0
    ]);
    } else {
    $shopkeeper->update([
    'status' => 1
    ]);
    }
    return redirect()->route('superadmins.shopkeepers.index')->with(['shopkeeper-status-updated'=>'Status is successfully Updated!!']);
    }
    
    // create pdf
    public function createPDF()
    {
    // retreive all records from db
    $data = Shopkeeper::latest()->get();
    // share data to view
    view()->share('shopkeepers', $data);
    $pdf = PDF::loadView('superadmin.pdf.shopkeeper', $data->all());
    //download PDF file with download method
    return $pdf->download('shopkeeper List.pdf');
    }
}
