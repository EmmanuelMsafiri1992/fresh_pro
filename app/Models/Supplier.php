<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
protected $fillable = 
[
'name', 'email', 'phone_number', 'profile_picture', 'company_name', 'designation', 'address', 'status'
];
public function purchases()
{
return $this->hasMany('App\Models\Purchase');
}

public function profilePic()
{
if (isset($this->profile_picture)) {
return asset('img/suppliers/' . $this->profile_picture);
}
}

public function isActive()
{
return $this->status == 1 ? true : false;
}
}
