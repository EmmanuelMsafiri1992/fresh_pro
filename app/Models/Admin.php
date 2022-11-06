<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\SuperAdmin;

class Admin extends Authenticatable
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
// Each admin is belonged by a super admin
public function superadmin()
{
return $this->belongsTo(SuperAdmin::class);
}
}
