<?php
// namespace App\Models;

include("./vendor/autoload.php");

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Category;
$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'scandiweb_store',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);


// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

require("src/GraphQL/boot.php");
// $cat = Category::find(2);
// var_dump($cat->products->toArray());