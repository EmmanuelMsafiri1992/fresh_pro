<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Retailer;
use PDF;

class RetailerController extends Controller
{
    public function index()
    {
    $query = Retailer::query();
    if (request('term')) {
    $term = request('term');
    $query->where('name', 'Like', '%' . $term . '%')
    ->orWhere('email', 'Like', '%' . $term . '%');
    }
    $retailers = $query->orderBy('id', 'DESC')->paginate(15);
    return view('superadmin.retailer.index', compact('retailers'));
    }

    public function create()
    {
    return view('superadmin.retailer.create');
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
    $user = Retailer::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
    
    return redirect()->route('superadmins.retailers.index')->with(['retailer-saved'=>'Retailer is successfully Saved!']);
    }
    
    public function show($id)
    {
    return redirect()->route('superadmins.retailers.index');
    }
    
    public function edit($id)
    {
    $retailer = Retailer::findOrFail($id);
    return view('superadmin.retailer.edit', compact('retailer'));
    }
    
    public function update(Request $request, $id)
    {
    $retailer = Retailer::findOrFail($id);
    
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'password' => $request->password ? 'nullable|string|min:8|max:255|confirmed' : '',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    'status'=>'required|notIn:2',
    ]);
    
    $imageName = $retailer->profile_picture;
    
    // remove current image and upload new image
    if (isset($request->profilePic)) {
    $this->deleteImage('img/profile/' . $retailer->profile_picture);
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    
    $request->password ? $password = Hash::make($request->password) : $password = $retailer->password;
    
    // update user
    $retailer->update([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $password,
    'profile_picture' => $imageName,
    'role' => $request->accountType,
    'status' => $request->status,
    ]);
    
    return redirect()->route('superadmins.retailers.index')->with(['retailer-updated'=>'Retailer is successfully Saved!']);
    }
    
    public function destroy($id)
    {
    $user = Retailer::findOrFail($id);
    
    // delete user image from storage
    $this->deleteImage('img/profile/' . $user->profile_picture);
    
    // delete user
    $user->delete();
    return redirect()->route('superadmins.retailers.index')->with(['retailer-deleted'=>'Retailer is successfully Saved!']);
    }

    public function changeStatus($id)
    {
    $retailer = Retailer::findOrFail($id);
    // change staff status
    if ($retailer->status == 1) {
    $retailer->update([
    'status' => 0
    ]);
    } else {
    $retailer->update([
    'status' => 1
    ]);
    }
    return redirect()->route('superadmins.retailers.index')->with(['retailer-status-updated'=>'Status is successfully Updated!']);
    }
    
    // create pdf
    public function createPDF()
    {
    // retreive all records from db
    $data = Retailer::latest()->get();
    // share data to view
    view()->share('retailers', $data);
    $pdf = PDF::loadView('superadmin.pdf.retailer', $data->all());
    //download PDF file with download method
    return $pdf->download('retailer List.pdf');
    }
}
