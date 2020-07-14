<?php
##CART.PHP PROCESSOR##
include("dbconnection.php") ;
$status="";
if(isset($_SESSION['shopping_cart'] )&& !empty($_SESSION['shopping_cart'])) {


    ####REMOVE ITEM####
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


// th actions input value is used to recalculate on quantity change
//    if (isset($_POST['action']) && $_POST['action'] == "change") {
//        foreach ($_SESSION["shopping_cart"] as &$value) {
//            if ($value['code'] === $_POST["code"]) {
//                $value['quantity'] = $_POST['quantity'];
////                $_SESSION['quantity'] = $_POST["quantity"];
//                break; // Stop the loop after we've found the product
//            }
//        }
//    }


##### INCREMENT OR ADDITION######
    if (isset($_POST['action']) && $_POST['action'] == "change2") {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST['code'] === $key) {
                $quantity = $_SESSION['shopping_cart'][$key]["quantity"];
                $_SESSION['shopping_cart'][$key]["quantity"] = $quantity + 12;
                break; // Stop the loop after we've found the product
            }
        }
    }


#####SUBTRACTION######
    if (isset($_POST['action']) && $_POST['action'] == "change1") {
//    if (isset($_POST['action']) && $_POST['action'] == "change") {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($_POST["code"] === $key) {
                $quantity = $_SESSION['shopping_cart'][$key]["quantity"];

                if ($quantity <= 12){
                    //once quanity is lesser than 12 unset that items session
                    unset($_SESSION['shopping_cart'][$key]);
//                    and if removing said item emptys the cart uunsett all cart seessions and redirect home
                    if (empty($_SESSION["shopping_cart"])) {
                        unset($_SESSION["shopping_cart"]);
                        header("Location:index.php");
                    }
                } else {
                    $_SESSION['shopping_cart'][$key]["quantity"] = $quantity - 12;

                    break; // Stop the loop after we've found the product
                }
            }
        }

    }
    #####this processes get rreequest done by our item add and subtraction to display qty an subtotal######
    if (isset($_GET["code_with_new_qty"]) && !empty($_GET['code_with_new_qty'])) {
        $code = $_GET['code_with_new_qty'];
        foreach (($_SESSION["shopping_cart"]) as $key => $value) {
            if ($_GET["code_with_new_qty"] === $key) {
                $quantity2 = $_SESSION['shopping_cart'][$key]['quantity'];
                $final = $quantity2 * $_SESSION['shopping_cart'][$key]["price"];
                echo(json_encode(array('item_qty' => $quantity2, 'subtotal' => $final))); //output json
            }
        }
    }
################## calcuate total amount Note we use the class as post###################
    if (isset($_POST["total_cart_amount"])) {
        ####name assigned is used in javascript##
        $_POST["total_cart_amount"] = "final_amount";
        if (isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0) { //if we have session variable

            $total_cart_amount = 0;
            foreach ($_SESSION["shopping_cart"] as $key => $value) { //loop though items and prepare html content

                $product_price = $_SESSION['shopping_cart'][$key]["price"];
                $product_qty = $_SESSION['shopping_cart'][$key]['quantity'];
                $subtotal = ($product_price * $product_qty);
                $total_cart_amount = ($total_cart_amount + $subtotal);
                //adding total amout to the array
                $_SESSION['total_cart_amount']=$total_cart_amount;
                $tots=  $_SESSION['total_cart_amount'];
            }
            echo(number_format($tots)); //exit and output content
            exit;
        }
    }
if(isset($_POST["customer_code"])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
        $_SESSION['shopping_cart'][$key]['customer_name'] = $name;
        $_SESSION['shopping_cart'][$key]['customer_email'] = $email;
    }
   $customer_name= $_SESSION['shopping_cart'][$key]['customer_name'];
   $customer_email= $_SESSION['shopping_cart'][$key]['customer_email'];
die(json_encode(array('name'=>$customer_name,'email'=>$customer_email)));
//   header("Location:order_review_&_initialize_payment.php");
}
}
?>
