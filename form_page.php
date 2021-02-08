<?php

function add_mymenu() {
    add_menu_page("WP-DPG", "WP-DPG", 'administrator', __FILE__, "return_form");

    add_action("admin_init", "register_mysettings");

}

function register_mysettings() {
    register_setting("dummy-products", "product");
    
}

add_action("admin_menu", "add_mymenu");

function get_images($q) {
    $response = file_get_contents( 'http://joshuasegal-imagesearch.herokuapp.com/' . $q );
    $response_v2 = str_replace(["[", "]"], [""], $response);
    return explode(",", $response_v2);
}

require "csv.php";

function print_link() {
    print "<a href=\"products.csv\" download=\"products.csv\" \">Download Products CSV</a>";
    print "<br>Current Product:" . get_option("product");
    print "<br><br>";
}

function check_if_product_empty() {
    if(get_option("product") == "") {
        return true;
    }
    return false;
}

function generate_product_file() {
        
    if(!check_if_product_empty()) {
        $image_urls = get_images(get_option("product"));

    $writer = new csv_writer("products.csv");
    $writer->write(array("Images", "Type", "Published", "Sales price"));
    
    foreach($image_urls as $image_url) {
        $writer->write(array($image_url, "simple", "1", "59.99"));
    }
    
    print_link();
}

    else {
        
    }
}

?>
<?php 
function return_form() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>

    <style>
        .form-update {
            position: relative; 
            top: 15px;
        }
    </style>
</head>
<body>
<div class="form-update">
    <h1>WooCommerce Product Generator</h1>
    <hr>
    <form method="POST" action="options.php">
    <?php 
    settings_fields("dummy-products"); 
    do_settings_sections("dummy-products");
    ?>
   
        <input class="" placeholder="Product Name" name="product">
        <br><br>
        <?php generate_product_file(); ?>
        <button class="btn-primary btn" type="submit">Generate Products</button>
        <br>   
 
    </form>
</div>
</body>
</html>
<?php } ?>
