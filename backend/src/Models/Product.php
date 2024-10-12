<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{

    protected $fillable = ['id', 'name', 'in_stock', 'description', 'category_id', 'brand'];

    protected $table = "products";


    public $timestamps = false;

    //relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }


    public function attributes()
    {
        return $this->hasMany(Attributes::class);
    }

    public function prices()
    {
        return $this->hasOne(Prices::class);  // Assuming each product has one price
    }

}
