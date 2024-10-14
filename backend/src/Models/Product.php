<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Product extends Model
{

    protected $fillable = ['id', 'name', 'in_stock', 'description', 'category_id', 'brand'];

    protected $table = "products";


    public $timestamps = false;

    //relationships


    protected $primaryKey = 'sku_id'; // تحديد الـ primary key

    // علاقة مع الـ Attributes
    public function attributes()
    {
        return $this->hasMany(Attributes::class, 'sku_id');
    }

    // علاقة مع الـ Prices
    public function prices()
    {
        return $this->hasMany(Prices::class, 'product_id'); // تأكد من أن 'product_id' هو العمود الصحيح
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class, 'sku_id');
    }



    public function cart_items()
    {
        return $this->hasMany(CartItem::class, 'sku_id');  // Assuming each product has one price
    }

}
