<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=
    ['category_id','name','description','status','quantity','price','profile_picture'];
    public function isActive()
    {
    return $this->status == 1 ? true : false;
    }
    // each product is belonged to a category
    public function category()
    {
    return $this->belongsTo(Category::class);
    }
}
