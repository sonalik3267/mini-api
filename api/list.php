<?php

header("Content-Type: application/json");

try {

    $products = [

        [
            "id" => 1,
            "name" => "Semi-Stitched Lehenga Choli",
            "brand" => "Fashion Store",
            "price" => 695,
            "category" => "Women's Ethnic Wear",
            "fabric" => "Georgette",
            "size" => "Free Size",
            "color" => "Maroon",
            "work" => "Embroidered",
            "rating" => "4.4",
            "discount" => "30% OFF",
            "stock" => "In Stock",
            "image" => "assets/product1.jpg"
        ],

        [
            "id" => 2,
            "name" => "Women Solid Single Breasted Casual Blazer",
            "brand" => "Fashion Store",
            "price" => 995,
            "category" => "Women's Blazer",
            "fabric" => "Polyester Blend",
            "size" => "S, M, L, XL",
            "color" => "Black",
            "work" => "Solid",
            "rating" => "4.5",
            "discount" => "25% OFF",
            "stock" => "In Stock",
            "image" => "assets/product2.jpg"
        ],

        [
            "id" => 3,
            "name" => "Milvia Cotton Embroidered Tunic with Trousers",
            "brand" => "Milvia",
            "price" => 1599,
            "category" => "Tunic Set",
            "fabric" => "Cotton",
            "size" => "S, M, L, XL",
            "color" => "Blue",
            "work" => "Embroidered",
            "rating" => "4.6",
            "discount" => "20% OFF",
            "stock" => "In Stock",
            "image" => "assets/product3.jpg"
        ],

        [
            "id" => 4,
            "name" => "Cottinfab Khaki Solid Blazer And Trouser Co-ord",
            "brand" => "Cottinfab",
            "price" => 1199,
            "category" => "Co-ord Set",
            "fabric" => "Cotton Blend",
            "size" => "S, M, L, XL",
            "color" => "Khaki",
            "work" => "Solid",
            "rating" => "4.5",
            "discount" => "28% OFF",
            "stock" => "Limited Stock",
            "image" => "assets/product4.jpg"
        ],

        [
            "id" => 5,
            "name" => "Designer Sharara Suit Set",
            "brand" => "Fashion Store",
            "price" => 2199,
            "category" => "Sharara Suit",
            "fabric" => "Net",
            "size" => "M, L, XL",
            "color" => "Sage Green",
            "work" => "Heavy Embroidery",
            "rating" => "4.8",
            "discount" => "35% OFF",
            "stock" => "In Stock",
            "image" => "assets/product5.jpg"
        ],

        [
            "id" => 6,
            "name" => "Special Heavy Embroidery Kurta Sharara Set",
            "brand" => "Fashion Store",
            "price" => 2299,
            "category" => "Kurta Sharara Set",
            "fabric" => "Silk Blend",
            "size" => "M, L, XL, XXL",
            "color" => "Pink",
            "work" => "Heavy Embroidery",
            "rating" => "4.9",
            "discount" => "40% OFF",
            "stock" => "In Stock",
            "image" => "assets/product6.jpg"
        ]

    ];

    echo json_encode(
        [
            "status" => true,
            "total_products" => count($products),
            "products" => $products
        ],
        JSON_PRETTY_PRINT
    );

} catch (Exception $e) {

    echo json_encode(
        [
            "status" => false,
            "message" => $e->getMessage()
        ],
        JSON_PRETTY_PRINT
    );

}

?>