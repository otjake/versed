<?php
include("dbconnection.php") ;

$status="";
if(isset($_SESSION['shopping_cart'] )&& !empty($_SESSION['shopping_cart'])) {

    if (isset($_POST['dece'])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["code"] === $key) {
                $quantity = $_POST['quantity'];
                if ($quantity <= 12) {
                    //once quanity is lesser than 12 unset that items session
                    unset($_SESSION['shopping_cart'][$key]);
//                    and if thats the last item inn the cart uunsett all cart seessions and redirect home
                    if (empty($_SESSION["shopping_cart"])) {
                        unset($_SESSION["shopping_cart"]);
                        header("Location:index.html");
                    }
                } else {
                    $_SESSION['shopping_cart'][$key]["quantity"] = $quantity - 12;
                    $final=$_SESSION['shopping_cart'][$key]["quantity"] * $_SESSION['shopping_cart'][$key]["price"];
//                    var_dump($_SESSION['shopping_cart'][$key]["quantity"]);
//                    var_dump($final);
                   echo(json_encode(array('success' => $_SESSION['shopping_cart'][$key]["quantity"])));
                    die(json_encode(array('result' => $final)));

                    break; // Stop the loop after we've found the product
                }
            }
        }
    }
}
?>
