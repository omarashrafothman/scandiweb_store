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
                return Category::with('products.attributes', 'products.galleries')->get(); // جلب جميع الفئات مع المنتجات
            },
        ],
        "category" => [
            "type" => $categoryType,
            "args" => [
                "id" => Type::int(),
            ],
            "resolve" => function ($root, $args) {
                return Category::with('products.attributes', 'products.galleries')->find($args["id"]); // جلب فئة معينة مع المنتجات
            },
        ],
        "products" => [
            "type" => Type::listOf($productType),
            "resolve" => function () {
                return Product::with('attributes')->get(); // جلب جميع المنتجات مع الخصائص والمعرض
            },
        ],
        "product" => [
            "type" => $productType,
            "args" => [
                "id" => Type::string(),
            ],
            "resolve" => function ($root, $args) {
                return Product::with('attributes', 'prices')->find($args["id"]);
            },
        ],
    ],
]);