<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wholeseller;
use Illuminate\Support\Facades\Hash;
use PDF;

class WholesallerController extends Controller
{
    public function index()
    {
    $query = Wholeseller::query();
    if (request('term')) {
    $term = request('term');
    $query->where('name', 'Like', '%' . $term . '%')
    ->orWhere('email', 'Like', '%' . $term . '%');
    }
    $wholesellers = $query->orderBy('id', 'DESC')->paginate(15);
    return view('superadmin.wholeseller.index', compact('wholesellers'));
    }

    public function create()
    {
    return view('superadmin.wholeseller.create');
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
    $user = Wholeseller::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
    return redirect()->route('superadmins.wholesellers.index')->with(['wholeseller-saved'=>'Record successfully Saved']);
    }
    
    public function show($id)
    {
    return redirect()->route('superadmins.wholesellers.index');
    }
    
    public function edit($id)
    {
    $wholeseller = Wholeseller::findOrFail($id);
    return view('superadmin.wholeseller.edit', compact('wholeseller'));
    }
    
    public function update(Request $request, $id)
    {
    $wholeseller = Wholeseller::findOrFail($id);
    
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'password' => $request->password ? 'nullable|string|min:8|max:255|confirmed' : '',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    'status'=>'required|notIn:2',
]);
    
    $imageName = $wholeseller->profile_picture;
    
    // remove current image and upload new image
    if (isset($request->profilePic)) {
    $this->deleteImage('img/profile/' . $wholeseller->profile_picture);
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    
    $request->password ? $password = Hash::make($request->password) : $password = $wholeseller->password;
    
    // update user
    $wholeseller->update([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $password,
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
    
    return redirect()->route('superadmins.wholesellers.index')->with(['wholeseller-updated'=>'Record successfully Updated']);
    }
    
    public function destroy($id)
    {
    $user = Wholeseller::findOrFail($id);
    
    // delete user image from storage
    $this->deleteImage('img/profile/' . $user->profile_picture);
    
    // delete user
    $user->delete();
    return redirect()->route('superadmins.wholesellers.index')->with(['wholeseller-deleted'=>'Record successfully Deleted']);
    }

    public function changeStatus($id)
    {
    $wholeseller = Wholeseller::findOrFail($id);
    // change staff status
    if ($wholeseller->status == 1) {
    $wholeseller->update([
    'status' => 0
    ]);
    } else {
    $wholeseller->update([
    'status' => 1
    ]);
    }
    return redirect()->route('superadmins.wholesellers.index')->with(['wholeseller-status-updated'=>'Status is successfully Updated!']);
    }
    
    // create pdf
    public function createPDF()
    {
    // retreive all records from db
    $data = Wholeseller::latest()->get();
    // share data to view
    view()->share('wholesellers', $data);
    $pdf = PDF::loadView('superadmin.pdf.wholeseller', $data->all());
    //download PDF file with download method
    return $pdf->download('wholeseller List.pdf');
    }
}
