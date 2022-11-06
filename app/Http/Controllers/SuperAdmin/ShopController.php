<?php
namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Shopkeeper;
use PDF;

class ShopController extends Controller
{
    public function index()
    {
        $query =Shop::query();
        if (request('term')) {
        $term = request('term');
        $query->where('name', 'Like', '%' . $term . '%');
        }
        $shops = $query->orderBy('id', 'DESC')->with('shopkeeper')->paginate(15);
        return view('superadmin.shop.index', compact('shops'));
    }
    public function create()
    {
    $shopkeepers=Shopkeeper::all();
    return view('superadmin.shop.create')->with(['shopkeepers'=>$shopkeepers]);
    }

    public function store(Request $request)
    {
    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'shopkeeper_id'=>'required|notIn:0',
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
    $user = Shop::create([
    'name' => $request->name,
    'shopkeeper_id' => $request->shopkeeper_id,
    'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
        return redirect()->route('superadmins.shops.index')->with(['shop-saved'=>'Record is successfully Saved!']);
    }

    public function show($id)
    {
    return redirect()->route('superadmins.shops.index');
    }

    public function edit($id)
    {
    $shop = shop::findOrFail($id);
    $shopkeepers=Shopkeeper::all();
    return view('superadmin.shop.edit', compact('shop','shopkeepers'));
    }

    public function update(Request $request, $id)
    {
    $shop = shop::findOrFail($id);

    // validate form
    $validator = $request->validate([
    'name' => 'required|string|max:50',
    'shopkeeper_id'=>'required|notIn:0',
    'status'=>'required|notIn:2',
    'profilePic' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    $imageName = $shop->profile_picture;

    // remove current image and upload new image
    if (isset($request->profilePic)) {
    $this->deleteImage('img/profile/' . $shop->profile_picture);
    $imagePath = 'img/profile';
    $imageName = $this->uploadImage($imagePath, $request->profilePic);
    }
    // update user
    $shop->update([
    'name' => $request->name,
    'shopkeeper_id' => $request->shopkeeper_id,
     'profile_picture' => $imageName,
    'status' => $request->status,
    ]);
    return redirect()->route('superadmins.shops.index')->with(['shop-updated'=>'Record is successfully Updated!']);
}

    public function destroy($id)
    {
    $user = shop::findOrFail($id);

    // delete user image from storage
    $this->deleteImage('img/profile/' . $user->profile_picture);

    // delete user
    $user->delete();
    return redirect()->route('superadmins.shops.index')->with(['shop-deleted'=>'Record is successfully Deleted!']);
}

    public function changeStatus($id)
    {
    $shop = shop::findOrFail($id);
    // change staff status
    if ($shop->status == 1) {
    $shop->update([
    'status' => 0
    ]);
    } else {
    $shop->update([
    'status' => 1
    ]);
    }
    return redirect()->route('superadmins.shops.index')->with(['shop-status-updated'=>'Status is successfully Updated!']);
}

    // create pdf
    public function createPDF()
    {
    // retreive all records from db
    $data = Shop::latest()->get();
    // share data to view
    view()->share('shops', $data);
    $pdf = PDF::loadView('superadmin.pdf.shop', $data->all());
    //download PDF file with download method
    return $pdf->download('shop List.pdf');
    }
}
