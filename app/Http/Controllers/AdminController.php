<?php
namespace App\Http\Controllers;
use App\Charts\ExpenseChart;
use App\Charts\FinishedQtyChart;
use App\Charts\PurchaseChart;
use App\Charts\TransferredQtyChart;
use App\Models\Category;
use App\Models\Expense;
use App\Models\FinishedProduct;
use App\Models\ProcessingProduct;
use App\Models\Purchase;
use App\Models\Staff;
use App\Models\SubCategory;
use App\Models\Supplier;
use App\Models\TransferredProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
public function index(){
    return view('admin.users.index');
}
public function create(){
    return view('admin.users.create');
}
public function dashboard()
{
return view('admin.dashboard');
}

// return super admin profile page
public function profilePage()
{
return view('backend_template.profile_admin');
}
// profile update for super admin
public function profileUpdate(Request $request, $email)
{
    $user = Admin::where('email', $email)->first();
    $validator = $request->validate([
        'name' => 'required|string|max:50',
        'email' => 'required|string|max:80|unique:users,name,' . $user->id,
        'password' => $request->password ? 'nullable|string|min:8|max:255' : '',
        'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);


    $request->password ? $password = Hash::make($request->password) : $password = $user->password;

    $imageName = $user->profile_picture;
    if (!empty($request->profilePic)) {
        $this->deleteImage('img/profile/' . $user->profile_picture);
        $imageName = $this->uploadImage('img/profile/', $request->profilePic);
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $password,
        'profile_picture' => $imageName
    ]);

    return redirect()->route('admin.profile')->withSuccess('Profile updated successfully!');
}


// For login admin
public function authenticate(Request $request)
{
$request->validate([
'email' => 'required',
'password' => 'required',
]);
if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember')))
{
return redirect()->route('admin.dashboard');
}
else
{
return back()->with(['error'=>'Email Or Password Is Incorrect']);
}
}
// For logout admin
public function logout()
{
Auth::guard('admin')->logout();
return redirect()->route('login');
}
}
