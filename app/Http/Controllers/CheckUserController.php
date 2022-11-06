<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class CheckUserController extends Controller
{
public function index(Request $request)
{
$login=$request->user;
if($login=='superadmin')
{
return redirect()->route('superadmin.login');
}
if($login=='superadmin')
{
return redirect()->route('superadmin.login');
}
else if($login=='admin')
{
return redirect()->route('admin.login');
}
else if($login=='wholeseller')
{
return redirect()->route('wholeseller.login');
}
else if($login=='retailer')
{
return redirect()->route('retailer.login');
}
else if($login=='shopkeeper')
{
return redirect()->route('shopkeeper.login');
}
else if($login=='customer')
{
return redirect()->route('customer.login');
}
}
}
