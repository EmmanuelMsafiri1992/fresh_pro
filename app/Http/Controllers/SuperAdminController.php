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
use App\Models\SuperAdmin;
use App\Models\Hash;

class SuperAdminController extends Controller
{
    public function index()
{
    $stats = (object) ([
        'staff' => Staff::count(),
        'suppliers' => Supplier::count(),
        'categories' => Category::count(),
        'subCats' => SubCategory::count(),
        'purchases' => Purchase::count(),
        'processing' => ProcessingProduct::count(),
        'finished' => FinishedProduct::count(),
        'transferred' => TransferredProduct::count(),
        'expenses' => Expense::count()
    ]);

    // prepare  dataset for charts
    $purchasesByMonth = array();
    $finishedQtyByMonths = array();
    $transferredQtyByMonths = array();
    $expensesByMonth = array();
    for ($i = 1; $i <= 12; $i++) {
        // dataset for purchases
        $monthPurchase = Purchase::where('status', 1)->whereYear('purchase_date', '=', date("Y"))->whereMonth('purchase_date', '=', $i)->sum('total');
        $monthPurchase > 0 ? array_push($purchasesByMonth, $monthPurchase) : array_push($purchasesByMonth, 0);

        // dataset for finished products
        $finishedProducts = FinishedProduct::where('status', 1)->whereYear('finished_date', '=', date("Y"))->whereMonth('finished_date', '=', $i)->get();
        $total = 0;
        foreach ($finishedProducts as $key => $qty) {
            $arrayQuantities = explode(', ', $qty->quantities);
            foreach ($arrayQuantities as $singleQty) {
                $total += (int)$singleQty;
            }
        }
        $total > 0 ? array_push($finishedQtyByMonths, $total) : array_push($finishedQtyByMonths, 0);

        // dataset for transferred products
        $transferredProducts = TransferredProduct::where('status', 1)->whereYear('transferred_date', '=', date("Y"))->whereMonth('transferred_date', '=', $i)->get();
        $transTotal = 0;
        foreach ($transferredProducts as $key => $transQty) {
            $arrayTransQuantities = explode(', ', $transQty->transferred_quantities);
            foreach ($arrayTransQuantities as $transSingleQty) {
                $transTotal += (int)$transSingleQty;
            }
        }
        $transTotal > 0 ? array_push($transferredQtyByMonths, $transTotal) : array_push($transferredQtyByMonths, 0);

        // dataset for expenses
        $monthlyExpense = Expense::where('status', 1)->whereYear('expense_date', '=', date("Y"))->whereMonth('expense_date', '=', $i)->sum('amount');
        $monthlyExpense > 0 ? array_push($expensesByMonth, $monthlyExpense) : array_push($expensesByMonth, 0);
    }

    // purchases chart
    $purchasesChart = new PurchaseChart;
    // $purchasesChart->title('Purchases amount by Months', 20,"rgb(0, 0, 0)", true, 'Sen', 'sans-serif');
    $purchasesChart->barwidth(0.0);
    $purchasesChart->displaylegend(false);
    $purchasesChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
    $purchasesChart->dataset('Purchases by trimester', 'line', $purchasesByMonth)
        ->color('rgba(99,102,241, 1.0)')->backgroundcolor('rgba(99,102,241, 0.2)');

    //finished products chart
    $finishedQtyChart = new FinishedQtyChart;
    $finishedQtyChart->displaylegend(false);
    // $finishedQtyChart->title('Finished quantities by Months', 20, "rgb(0, 0, 0)", true, 'Sen', 'sans-serif');
    $finishedQtyChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
    $finishedQtyChart->dataset('Finished quantities by trimester', 'bar', $finishedQtyByMonths)
        ->color('rgba(99,102,241, 1.0)')->backgroundcolor('rgba(99,102,241, 0.2)');

    //transferred products chart
    $transferredQtyChart = new TransferredQtyChart;
    $transferredQtyChart->displaylegend(false);
    // $transferredQtyChart->title('Transferred quantities by Months', 20, "rgb(0, 0, 0)", true, 'Sen', 'sans-serif');
    $transferredQtyChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
    $transferredQtyChart->dataset('Transferred quantities by trimester', 'bar', $transferredQtyByMonths)
        ->color('rgba(99,102,241, 1.0)')->backgroundcolor('rgba(99,102,241, 0.2)');

    // expense chart
    $expenseChart = new ExpenseChart;
    // $expenseChart->title('Expenses amount by Months', 20, "rgb(0, 0, 0)", true, 'Sen', 'sans-serif');
    $expenseChart->barwidth(0.0);
    $expenseChart->displaylegend(false);
    $expenseChart->labels(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);
    $expenseChart->dataset('Expenses by trimester', 'line', $expensesByMonth)->color('rgba(99,102,241, 1.0)')->backgroundcolor('rgba(99,102,241, 0.2)');

    return view('admin.dashboard', compact('stats',  'purchasesChart', 'finishedQtyChart', 'transferredQtyChart', 'expenseChart'));
}

    public function dashboard()
{
return view('superadmin.dashboard');
}
// return super admin profile page
public function profilePage()
{
return view('backend_template.profile_superadmin');
}
// profile update for super admin
public function profileUpdate(Request $request, $email)
{
    $user = SuperAdmin::where('email', $email)->first();
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

    return redirect()->route('superadmin.profile')->withSuccess('Profile updated successfully!');
}

// For login admin
public function authenticate(Request $request)
{
$request->validate([
'email' => 'required',
'password' => 'required',
]);
if(Auth::guard('superadmin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember')))
{
return redirect()->route('superadmin.dashboard');
}
else
{
return back()->with(['error'=>'Email Or Password Is Incorrect']);
}
}
// For logout admin
public function logout()
{
Auth::guard('superadmin')->logout();
return redirect()->route('login');
}
}
