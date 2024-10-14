<?php
use App\Models\Category;
use App\Models\Product;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

$rootQuery = new ObjectType([
    "name" => "query",
    "fields" => [
        "categories" => [
            "type" => Type::listOf($categoryType),
            "resolve" => function () {
                return Category::with('products.attributes', 'products.galleries', 'products.prices')->get(); // جلب جميع الفئات مع المنتجات
            },
        ],
        "category" => [
            "type" => $categoryType,
            "args" => [
                "id" => Type::int(),
            ],
            "resolve" => function ($root, $args) {
                return Category::with('products.attributes', 'products.galleries', 'products.prices')->find($args["id"]); // جلب فئة معينة مع المنتجات
            },
        ],
        'products' => [
            'type' => Type::listOf($productType),
            'resolve' => function () {
                try {
                    // جلب المنتجات مع السمات باستخدام علاقة sku_id
                    return Product::with(['category', 'attributes', 'prices'])->get();
                } catch (Exception $e) {
                    throw new \GraphQL\Error\Error('فشل في جلب المنتجات: ' . $e->getMessage());
                }
            }
        ],
        "product" => [
            "type" => $productType,
            "args" => [
                "sku_id" => Type::int(),
            ],
            "resolve" => function ($root, $args) {
                return Product::with(['attributes', 'galleries', 'prices'])->where('sku_id', $args["sku_id"])->first();
            },
        ],
    ],
]);







