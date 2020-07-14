<?php
include("dbconnection.php") ;

$status="";
if(isset($_SESSION['shopping_cart'] )&& !empty($_SESSION['shopping_cart'])) {
    if (isset($_POST['action']) && $_POST['action'] == "remove") {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["code"] === $key) {
                unset($_SESSION['shopping_cart'][$key]);
                $status = "Product is removed from your cart!";
                die(json_encode(array("success" => $status)));
            }
            //once last item in cart is remove or $_SESSION["shopping_cart"] is empty redirect to home page
            if (empty($_SESSION["shopping_cart"])) {
                unset($_SESSION["shopping_cart"]);
                header("Location:index.php");
            }
        }
    }
}
?>
