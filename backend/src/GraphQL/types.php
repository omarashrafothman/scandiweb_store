<?php
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;




// category type 



$attributeType = new ObjectType([
    'name' => 'Attribute',
    'fields' => [
        // 'id' => Type::int(),
        'name' => Type::string(),
        'value' => Type::string(),
    ],
]);

$attributeItemType = new ObjectType([
    'name' => 'Attribute_item',
    'fields' => [
        'id' => Type::int(),
        'display_value' => Type::string(),
        'value' => Type::string(),
    ],
]);

$galleryType = new ObjectType([
    'name' => 'Gallery',
    'fields' => [
        'sku_id' => Type::int(),
        'image_url' => Type::string(),
    ],
]);
$pricesType = new ObjectType([
    'name' => 'prices',
    'fields' => [
        'product_id' => Type::int(),
        'amount' => Type::string(),
        'currency_label' => Type::string(),
        'currency_symbol' => Type::string()
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
    'fields' => function () use (&$categoryType, &$attributeType, &$galleryType, $pricesType) {
        return [
            'sku_id' => Type::int(),
            'id' => Type::string(),
            'name' => Type::string(),
            'prices' => Type::listOf($pricesType),


            'description' => Type::string(),
            'attributes' => Type::listOf($attributeType),
            'galleries' => Type::listOf($galleryType),
            'in_stock' => Type::boolean(),
            'category' => $categoryType,
        ];
    }
]);








