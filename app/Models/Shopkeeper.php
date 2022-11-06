<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Shop;

class Shopkeeper extends Authenticatable
{
use Notifiable;
protected $fillable = [
'name', 'email', 'password', 'profile_picture', 'status'
];
protected $hidden = [
'password', 'remember_token',
];
protected $casts = [
'email_verified_at' => 'datetime',
];
public function profilePic()
{
if (!empty($this->profile_picture)) {
return asset('img/profile/' . $this->profile_picture);
}
return asset('img/boy.png');
}
public function isActive()
{
return $this->status == 1 ? true : false;
}
}
