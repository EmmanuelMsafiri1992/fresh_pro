<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use PDF;


class ProductController extends Controller
{

public function index(Request $request)
{
$query = Product::query();
if (request('term')) {
$term = request('term');
$query->where('name', 'Like', '%' . $term . '%');
}
$products = $query->orderBy('id', 'DESC')->paginate(15);
return view('superadmin.product.index', compact('products'));
}

public function create()
{
    $categories=Category::all();
    return view('superadmin.product.create')->with(['categories'=>$categories]);
}

public function store(Request $request)
{
//validate form
$validator = $request->validate([
    'category_id'=>'required|notIn:0',
    'name' => 'required|string|max:50|unique:categories',
    'description'=>'required',
    'status'=>'required|notIn:2',
    'quantity'=>'required|min:1|max:100000',
    'price'=>'required|min:1|max:100000',
]);

// store category
$product = Product::create([
    'category_id'=>$request->category_id,
    'name' => $request->name,
    'description'=>$request->description,
    'status'=>$request->status,
    'quantity'=>$request->quantity,
    'price'=>$request->price,
    'profile_picture'=>$request->profile_picture,
]);
return redirect()->route('superadmins.products.index')->with(['product-saved'=>'Record is successfully Saved!']);
}

public function show($id)
{
return redirect()->route('superadmins.products.index');
}

public function edit($id)
{
$categories=Category::all();
$product = Product::where('id', $id)->first();
return view('superadmin.product.edit', compact('product','categories'));
}

public function update(Request $request, $id)
{
$product = Product::where('id', $id)->first();

//validate form
$validator = $request->validate([
    'category_id'=>'required|notIn:0',
    'name' => 'required|string|max:50|unique:categories',
    'description'=>'required',
    'status'=>'required|notIn:2',
    'quantity'=>'required|min:1|max:100000',
    'price'=>'required|min:1|max:100000',
]);

// update category
$product->update([
    'category_id'=>$request->category_id,
    'name' => $request->name,
    'description'=>$request->description,
    'status'=>$request->status,
    'quantity'=>$request->quantity,
    'price'=>$request->price,
    'profile_picture'=>$request->profile_picture,
]);
return redirect()->route('superadmins.products.index')->with(['product-updated'=>'Record is successfully Updated!']);
}

public function destroy($id)
{
$product = Product::where('id', $id)->first();
// destroy product
$product->delete();
return redirect()->route('superadmins.products.index')->with(['product-deleted'=>'Record is successfully Deleted!']);
}

public function changeStatus($id)
{
$product = Product::where('id', $id)->first();

// change category status
if ($product->status == 1) {
$product->update([
'status' => 0
]);
} else {
$product->update([
'status' => 1
]);
}
return redirect()->route('superadmins.products.index')->with(['product-status-updated'=>'Status is successfully Updated!']);
}

// create pdf
public function createPDF()
{
// retreive all records from db
$data = Product::latest()->get();
// share data to view
view()->share('products', $data);
$pdf = PDF::loadView('superadmin.pdf.product', $data->all());
// download PDF file with download method
return $pdf->download('categories-list.pdf');
}
}
