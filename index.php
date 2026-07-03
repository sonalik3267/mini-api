<?php

session_start();

if (!isset($_SESSION["user"])) {
    header("Location: signin.php");
    exit;
}

date_default_timezone_set("Asia/Kolkata");

$productData = [];
$orderMessage = "";
$orders = [];

$search = trim($_GET["search"] ?? "");
$brand = trim($_GET["brand"] ?? "");
$sort = trim($_GET["sort"] ?? "");

/* Fashion Products */

$productData = [

[
"id"=>1,
"name"=>"Semi-Stitched Lehenga Choli",
"brand"=>"Fashion Store",
"price"=>695,
"category"=>"Women's Ethnic Wear",
"fabric"=>"Georgette",
"size"=>"Free Size",
"color"=>"Maroon",
"work"=>"Embroidery",
"rating"=>"4.4",
"discount"=>"30% OFF",
"stock"=>"In Stock",
"image"=>"assets/product1.jpg"
],

[
"id"=>2,
"name"=>"Women Solid Single Breasted Casual Blazer",
"brand"=>"Fashion Store",
"price"=>995,
"category"=>"Women's Blazer",
"fabric"=>"Polyester Blend",
"size"=>"S, M, L, XL",
"color"=>"Black",
"work"=>"Solid",
"rating"=>"4.5",
"discount"=>"25% OFF",
"stock"=>"In Stock",
"image"=>"assets/product2.jpg"
],

[
"id"=>3,
"name"=>"Milvia Cotton Embroidered Tunic with Trousers",
"brand"=>"Milvia",
"price"=>1599,
"category"=>"Tunic Set",
"fabric"=>"Cotton",
"size"=>"S, M, L, XL",
"color"=>"Blue",
"work"=>"Embroidery",
"rating"=>"4.6",
"discount"=>"20% OFF",
"stock"=>"In Stock",
"image"=>"assets/product3.jpg"
],

[
"id"=>4,
"name"=>"Cottinfab Khaki Solid Blazer And Trouser Co-ord",
"brand"=>"Cottinfab",
"price"=>1199,
"category"=>"Co-ord Set",
"fabric"=>"Cotton Blend",
"size"=>"S, M, L, XL",
"color"=>"Khaki",
"work"=>"Solid",
"rating"=>"4.5",
"discount"=>"28% OFF",
"stock"=>"Limited Stock",
"image"=>"assets/product4.jpg"
],

[
"id"=>5,
"name"=>"Designer Sharara Suit Set",
"brand"=>"Fashion Store",
"price"=>2199,
"category"=>"Sharara Suit",
"fabric"=>"Net",
"size"=>"M, L, XL",
"color"=>"Sage Green",
"work"=>"Heavy Embroidery",
"rating"=>"4.8",
"discount"=>"35% OFF",
"stock"=>"In Stock",
"image"=>"assets/product5.jpg"
],

[
"id"=>6,
"name"=>"Special Heavy Embroidery Kurta Sharara Set",
"brand"=>"Fashion Store",
"price"=>2299,
"category"=>"Kurta Sharara",
"fabric"=>"Silk Blend",
"size"=>"M, L,XL,XXL",
"color"=>"Pink",
"work"=>"Heavy Embroidery",
"rating"=>"4.9",
"discount"=>"40% OFF",
"stock"=>"In Stock",
"image"=>"assets/product6.jpg"
]

];

if($search!=""){

$productData=array_filter($productData,function($item)use($search){

return stripos($item["name"],$search)!==false ||
stripos($item["brand"],$search)!==false;

});

}

if($brand!=""){

$productData=array_filter($productData,function($item)use($brand){

return $item["brand"]==$brand;

});

}

if($sort=="low"){

usort($productData,function($a,$b){

return $a["price"]<=>$b["price"];

});

}

if($sort=="high"){

usort($productData,function($a,$b){

return $b["price"]<=>$a["price"];

});

}

if(file_exists("orders.json")){

$orders=json_decode(file_get_contents("orders.json"),true);

if(!is_array($orders)){

$orders=[];

}

}

$totalProducts=count($productData);
$totalBrands=count(array_unique(array_column($productData,"brand")));
$totalOrders=count($orders);

?>

<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width,initial-scale=1.0">

<title>Fashion Store Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<header>

<h1>Fashion Store Dashboard</h1>

<p>

Welcome,

<strong><?php echo htmlspecialchars($_SESSION["user"]["name"]); ?></strong>

</p>

<a href="logout.php" class="logout-btn">

Logout

</a>

</header>

<div class="container">

<div class="sale-banner">

👗 Fashion Mega Sale - Up to 40% OFF

</div>

<div class="stats-grid">

<div class="stats-card">

<h3>Total Products</h3>

<p><?php echo $totalProducts; ?></p>

</div>

<div class="stats-card">

<h3>Total Brands</h3>

<p><?php echo $totalBrands; ?></p>

</div>

<div class="stats-card">

<h3>Total Orders</h3>

<p><?php echo $totalOrders; ?></p>

</div>

</div>

<div class="card">

<h2>Search Fashion Products</h2>

<form method="GET">

<input
type="text"
name="search"
placeholder="Search Fashion Products"
value="<?php echo htmlspecialchars($search); ?>"
>

<select name="brand">

<option value="">All Brands</option>

<option value="Fashion Store" <?php if($brand=="Fashion Store") echo "selected"; ?>>
Fashion Store
</option>

<option value="Milvia" <?php if($brand=="Milvia") echo "selected"; ?>>
Milvia
</option>

<option value="Cottinfab" <?php if($brand=="Cottinfab") echo "selected"; ?>>
Cottinfab
</option>

</select>

<select name="sort">

<option value="">Sort By Price</option>

<option value="low" <?php if($sort=="low") echo "selected"; ?>>
Low To High
</option>

<option value="high" <?php if($sort=="high") echo "selected"; ?>>
High To Low
</option>

</select>

<button type="submit">

Search

</button>

</form>

</div>

<div class="card">

<h2>Fashion Products</h2>

<div class="product-grid">

<?php if(!empty($productData)){ ?>

<?php foreach($productData as $item){ ?>

<div class="product-card">

<div class="image-box">

<img
src="<?php echo htmlspecialchars($item["image"]); ?>"
alt="<?php echo htmlspecialchars($item["name"]); ?>"
>

</div>

<h3>

<?php echo htmlspecialchars($item["name"]); ?>

</h3>

<p>

<strong>Brand :</strong>

<?php echo htmlspecialchars($item["brand"]); ?>

</p>

<p>

<strong>Category :</strong>

<?php echo htmlspecialchars($item["category"]); ?>

</p>

<p>

<strong>Fabric :</strong>

<?php echo htmlspecialchars($item["fabric"]); ?>

</p>

<p>

<strong>Size :</strong>

<?php echo htmlspecialchars($item["size"]); ?>

</p>

<p>

<strong>Color :</strong>

<?php echo htmlspecialchars($item["color"]); ?>

</p>

<p>

<strong>Work :</strong>

<?php echo htmlspecialchars($item["work"]); ?>

</p>

<p>

<strong>Rating :</strong>

⭐ <?php echo htmlspecialchars($item["rating"]); ?>

</p>

<p>

<strong>Stock :</strong>

<?php echo htmlspecialchars($item["stock"]); ?>

</p>

<p>

<strong>Discount :</strong>

<?php echo htmlspecialchars($item["discount"]); ?>

</p>

<div class="price">

₹<?php echo number_format($item["price"]); ?>

</div>

</div>

<?php } ?>

<?php } else { ?>

<div class="not-found">

<h2>No Product Found</h2>

<p>

Try another product name.

</p>

</div>

<?php } ?>

</div>

</div>

<div class="card">

<h2>Place Order</h2>

<form method="POST">

<input
type="text"
name="customer_name"
placeholder="Full Name"
required
>

<input
type="text"
name="mobile"
placeholder="Mobile Number"
required
>

<input
type="email"
name="email"
placeholder="Email Address"
required
>

<input
type="text"
name="address"
placeholder="Address"
required
>

<input
type="text"
name="city"
placeholder="City"
required
>

<input
type="text"
name="state"
placeholder="State"
required
>

<input
type="text"
name="pincode"
placeholder="Pincode"
required
>

<button
type="submit"
name="place_order">

Place Order

</button>

</form>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place_order"])) {

    $customerName = trim($_POST["customer_name"]);
    $mobile = trim($_POST["mobile"]);
    $email = trim($_POST["email"]);
    $address = trim($_POST["address"]);
    $city = trim($_POST["city"]);
    $state = trim($_POST["state"]);
    $pincode = trim($_POST["pincode"]);

    if (
        $customerName == "" ||
        $mobile == "" ||
        $email == "" ||
        $address == "" ||
        $city == "" ||
        $state == "" ||
        $pincode == ""
    ) {

        $orderMessage = "Please fill all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $orderMessage = "Invalid Email Address.";

    } else {

        $orders[] = [

            "customer_name" => htmlspecialchars($customerName),
            "mobile" => htmlspecialchars($mobile),
            "email" => strtolower($email),
            "address" => htmlspecialchars($address),
            "city" => htmlspecialchars($city),
            "state" => htmlspecialchars($state),
            "pincode" => htmlspecialchars($pincode),
            "date" => date("d M Y | h:i A")

        ];

        file_put_contents(
            "orders.json",
            json_encode(
                $orders,
                JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
            )
        );

        $orderMessage = "✅ Order Placed Successfully.";

    }

}

?>

<?php if($orderMessage!=""){ ?>

<div class="success-box">

<?php echo htmlspecialchars($orderMessage); ?>

</div>

<?php } ?>

</div>

<div class="card">

<h2>Order History</h2>

<?php if(!empty($orders)){ ?>

<?php foreach(array_reverse($orders) as $order){ ?>

<div class="product-card">

<p><strong>Name :</strong> <?php echo htmlspecialchars($order["customer_name"]); ?></p>

<p><strong>Mobile :</strong> <?php echo htmlspecialchars($order["mobile"]); ?></p>

<p><strong>Email :</strong> <?php echo htmlspecialchars($order["email"]); ?></p>

<p><strong>Address :</strong> <?php echo htmlspecialchars($order["address"]); ?></p>

<p><strong>City :</strong> <?php echo htmlspecialchars($order["city"]); ?></p>

<p><strong>State :</strong> <?php echo htmlspecialchars($order["state"]); ?></p>

<p><strong>Pincode :</strong> <?php echo htmlspecialchars($order["pincode"]); ?></p>

<p><strong>Date :</strong> <?php echo htmlspecialchars($order["date"]); ?></p>

</div>

<?php } ?>

<?php } else { ?>

<div class="not-found">

<h2>No Orders Yet</h2>

<p>

Place your first fashion order now.

</p>

</div>

<?php } ?>

</div>

</div>

<footer>

<p>© 2026 Fashion Store Dashboard</p>

<p>All Rights Reserved | Created by Deepika Gupta</p>

</footer>

</body>

</html>
