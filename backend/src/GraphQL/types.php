<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;




// category type 



$attributeType = new ObjectType([
    'name' => 'Attribute',
    'fields' => [
        'id' => Type::int(),
        'name' => Type::string(),
        'value' => Type::string(),
    ],
]);

$galleryType = new ObjectType([
    'name' => 'Gallery',
    'fields' => [
        'product_id' => Type::string(),
        'image_url' => Type::string(),
    ],
]);

$categoryType = new ObjectType([
    'name' => 'Category',
    'fields' => function () use (&$productType) { // استخدام دالة لتهيئة الحقول
        return [
            'id' => Type::int(),
            'name' => Type::string(),
            'products' => Type::listOf($productType),
        ];
    },
]);

$productType = new ObjectType([
    'name' => 'Product',
    'fields' => function () use (&$categoryType, &$attributeType, &$galleryType) {
        return [
            'id' => Type::string(),
            'name' => Type::string(),
            'price' => [
                'type' => Type::float(),
                'resolve' => function ($product) {
                    return $product->prices ? $product->prices->amount : null;
                },
            ],
            'description' => Type::string(),
            'attributes' => Type::listOf($attributeType),
            'galleries' => Type::listOf($galleryType),

            'category' => $categoryType,
        ];
    },
]);



