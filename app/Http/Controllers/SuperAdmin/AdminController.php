<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use PDF;

class AdminController extends Controller
{
public function index()
{
$query = Admin::query();
if (request('term')) {
$term = request('term');
$query->where('name', 'Like', '%' . $term . '%')
->orWhere('email', 'Like', '%' . $term . '%');
}
$admins = $query->orderBy('id', 'DESC')->paginate(15);
return view('superadmin.admin.index', compact('admins'));
}
public function create()
{
return view('superadmin.admin.create');
}

public function store(Request $request)
{
// validate form
$validator = $request->validate([
'name' => 'required|string|max:50',
'email' => 'required|string|email|max:80|unique:users',
'password' => 'required|string|min:8|confirmed',
'status'=>'required|notIn:2',
'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
]);

//upload selected image
$imageName = '';
if (isset($request->profilePic)) {
$imagePath = 'img/profile';
$imageName = $this->uploadImage($imagePath, $request->profilePic);
}

// store staff
$user = Admin::create([
'name' => $request->name,
'email' => $request->email,
'password' => Hash::make($request->password),
'profile_picture' => $imageName,
'status' => $request->status,
]);

return redirect()->route('superadmins.admins.index')->with(['admin-saved'=>'Record successfully Saved']);
}

public function show($id)
{
return redirect()->route('superadmins.admins.index');
}

public function edit($id)
{
$admin = Admin::findOrFail($id);
return view('superadmin.admin.edit', compact('admin'));
}

public function update(Request $request, $id)
{
$admin = Admin::findOrFail($id);

// validate form
$validator = $request->validate([
'name' => 'required|string|max:50',
'password' => $request->password ? 'nullable|string|min:8|max:255|confirmed' : '',
'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
'status'=>'required|notIn:2',
]);

$imageName = $admin->profile_picture;

// remove current image and upload new image
if (isset($request->profilePic)) {
$this->deleteImage('img/profile/' . $admin->profile_picture);
$imagePath = 'img/profile';
$imageName = $this->uploadImage($imagePath, $request->profilePic);
}

$request->password ? $password = Hash::make($request->password) : $password = $admin->password;

// update user
$admin->update([
'name' => $request->name,
'email' => $request->email,
'password' => $password,
'profile_picture' => $imageName,
'status' => $request->status,
]);
return redirect()->route('superadmins.admins.index')->with(['admin-updated'=>'Record successfully Updated']);
}

public function destroy($id)
{
$user = Admin::findOrFail($id);
// delete user image from storage
$this->deleteImage('img/profile/' . $user->profile_picture);
// delete user
$user->delete();
return redirect()->route('superadmins.admins.index')->with(['admin-deleted'=>'Record successfully Deleted']);
}
public function changeStatus($id)
{
$admin = Admin::findOrFail($id);
// change staff status
if ($admin->status == 1) {
$admin->update([
'status' => 0
]);
} else {
$admin->update([
'status' => 1
]);
}
return redirect()->route('superadmins.admins.index')->with(['admin-status-updated'=>'Status is successfully Updated!']);
}

// create pdf
public function createPDF()
{
// retreive all records from db
$data = Admin::latest()->get();
// share data to view
view()->share('admins', $data);
$pdf = PDF::loadView('superadmin.pdf.admin', $data->all());
//download PDF file with download method
return $pdf->download('Admin List.pdf');
}
}
