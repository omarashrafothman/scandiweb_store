<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Attributes extends Model
{

    protected $fillable = ['product_id', 'name', 'type'];

    protected $table = "attributes";


    public $timestamps = false;


    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributesItems()
    {
        return $this->hasMany(AttributeItems::class);
    }


}
