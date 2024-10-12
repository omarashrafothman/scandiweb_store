<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Gallery extends Model
{

    protected $fillable = ['product_id', 'image_url'];

    protected $table = "galleries";


    public $timestamps = false;
    protected $casts = [
        'product_id' => 'string', // Ensure product_id is treated as a string
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



}
