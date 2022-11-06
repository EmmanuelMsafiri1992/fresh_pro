<?php
namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
use Sluggable;
protected $fillable = [
'name', 'slug', 'note', 'status'
];

public function sluggable(): array
{
return [
'slug' => [
'source' => 'name'
]
];
}
public function subCategories()
{
return $this->hasMany('App\Models\SubCategory');
}
public function isActive()
{
return $this->status == 1 ? true : false;
}
public function shortNote()
{
if(strlen($this->note) > 80)
{
return substr($this->note, 0, 80).'...';
}
return $this->note;
}
// each category has many products
public function products()
{
return $this->hasMany(Product::class);
}
}
