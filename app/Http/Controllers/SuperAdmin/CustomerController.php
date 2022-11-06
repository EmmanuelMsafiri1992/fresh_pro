<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use PDF;

class CustomerController extends Controller
{
    public function index()
    {
    $query =Customer::query();
    if (request('term')) {
    $term = request('term');
    $query->where('name', 'Like', '%' . $term . '%')
    ->orWhere('email', 'Like', '%' . $term . '%');
    }
    $customers = $query->orderBy('id', 'DESC')->paginate(15);
    return view('superadmin.customer.index', compact('customers'));
    }

    public function create()
    {
    return view('superadmin.customer.create');
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
    $user =Customer::create([
    'name' => $request->name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
        return redirect()->route('superadmins.customers.index')->with(['customer-saved'=>'Record successfully Saved!']);
    }
    
    public function show($id)
    {
    return redirect()->route('superadmins.customers.index');
    }
    
    public function edit($id)
    {
    $customer =Customer::findOrFail($id);
    return view('superadmin.customer.edit', compact('customer'));
    }
    
    public function update(Request $request, $id)
    {
    $customer =Customer::findOrFail($id);
    
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'password' => $request->password ? 'nullable|string|min:8|max:255|confirmed' : '',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    'status'=>'required|notIn:2',
    ]);
    
    $imageName = $customer->profile_picture;
    
    // remove current image and upload new image
    if (isset($request->profilePic)) {
    $this->deleteImage('img/profile/' . $customer->profile_picture);
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    
    $request->password ? $password = Hash::make($request->password) : $password = $customer->password;
    
    // update user
    $customer->update([
    'name' => $request->name,
    'email' => $request->email,
    'password' => $password,
    'profile_picture' => $imageName,
    'role' => $request->accountType,
    'status' => $request->status,
    ]);
    return redirect()->route('superadmins.customers.index')->with(['customer-updated'=>'Record successfully Updated!']);
}
    
    public function destroy($id)
    {
    $user =Customer::findOrFail($id);
    
    // delete user image from storage
    $this->deleteImage('img/profile/' . $user->profile_picture);
    
    // delete user
    $user->delete();
    return redirect()->route('superadmins.customers.index')->with(['customer-Deleted'=>'Record successfully Deleted!']);
}

    public function changeStatus($id)
    {
    $customer =Customer::findOrFail($id);
    // change staff status
    if ($customer->status == 1) {
    $customer->update([
    'status' => 0
    ]);
    } else {
    $customer->update([
    'status' => 1
    ]);
    }
    return redirect()->route('superadmins.customers.index')->with(['customer-status-updated'=>'Customer status is successfully Updated!!']);
}
    
    // create pdf
    public function createPDF()
    {
    // retreive all records from db
    $data =Customer::latest()->get();
    // share data to view
    view()->share('customers', $data);
    $pdf = PDF::loadView('superadmin.pdf.customer', $data->all());
    //download PDF file with download method
    return $pdf->download('customer List.pdf');
    }
}
