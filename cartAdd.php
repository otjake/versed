<?php
include("dbconnection.php") ;

$status="";
global $status;

if(isset($_POST['code'])  ) {
    global $connection;
    $code = $_POST['code'];
    $get_item = "SELECT * FROM products WHERE `code`='{$code}'";
    $get_item_exec = mysqli_query($connection, $get_item);
    $row = mysqli_fetch_assoc($get_item_exec);
    $name = $row['name'];
    $code = $row['code'];
    $price = $row['price'];
    $image = $row['image'];

    $cartArray = array(
        $code => array(
            'name' => $name,
            'code' => $code,
            'price' => $price,
            'quantity' => 12,
            'image' => $image
        )
    );
    if (empty($_SESSION['shopping_cart'])) {
        //if shopping cart session dosent have clicked item button
        $_SESSION["shopping_cart"] = $cartArray;
//        $status = "<div class='alert alert-success'>Product is added to your cart!</div>";
        $cart_count = count($_SESSION['shopping_cart']);
//        echo(json_encode(array('count' =>$cart_count)));
        die(json_encode(array('success' => 'added', 'count' => $cart_count)));

    } else {
        //if item already exits
        //array_keys gets all the keys of an array
        $array_keys = array_keys($_SESSION["shopping_cart"]);
        //in_array  checks if an item exist in an array in this case a key
        if (in_array($code, $array_keys)) {
//            $status = "<div class='alert alert-info' style='color:red;'>
// Product is already added to your cart!</div>";
            die(json_encode(array('error' => 'unable')));

        } else {
            //if product keys or all keys don not exist in merge  our shopping cart session with our cart array which has values of the clicked button
            $_SESSION["shopping_cart"] = array_merge(
                $_SESSION["shopping_cart"],
                $cartArray
            );
//            $status = "<div class='alert alert-success'>Product is added to your cart!</div>";
            $cart_count = count($_SESSION['shopping_cart']);

            echo(json_encode(array('success' => 'addedcc', 'count' => $cart_count)));

        }


    }
//    if (isset($_GET["return_code"]) && !empty($_GET['return_code'])) {
//        $code = $_GET['return_code'];
//        $cart_count = count($_SESSION['shopping_cart']);
//        echo(json_encode(array('count' => $cart_count))); //output json
//    }

    }

?>
