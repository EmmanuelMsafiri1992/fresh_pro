<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shopkeeper;

class Shop extends Model
{
use HasFactory;
protected $fillable=['name','address','profile_picture','status','shopkeeper_id'];

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

// Each shop is assiated to a specific shopkeeper
public function shopkeeper()
{
return $this->belongsTo(ShopKeeper::class);
}
}
