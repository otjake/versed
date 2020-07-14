<?php
$status="";
$_ENV['status']=$status;
//function cartAdd(){
//    if(isset($_POST['code']) && !empty($_POST['code']) ){
//        global $connection;
//        $code=$_POST['code'];
//        $get_item="SELECT * FROM products WHERE `code`='{$code}'";
//        $get_item_exec=mysqli_query($connection,$get_item);
//        $row=mysqli_fetch_assoc($get_item_exec);
//        $name = $row['name'];
//        $code = $row['code'];
//        $price = $row['price'];
//        $image = $row['image'];
////
//        $cartArray = array(
//            $code=>array(
//                'name'=>$name,
//                'code'=>$code,
//                'price'=>$price,
//                'quantity'=>12,
//                'image'=>$image
//            )
//        );
//        if(empty($_SESSION['shopping_cart'])){
//            //if shopping cart session dosent have clicked item button
//            $_SESSION["shopping_cart"] = $cartArray;
//            $_ENV['status'] = "<div class='alert alert-success'>Product is added to your cart!</div>";
//        }
//        else{
////            //if item already exits
////            //array_keys gets all the keys of an array eg the code variable
//            $array_keys = array_keys($_SESSION["shopping_cart"]);
////            //in_array  checks if an item exist in an array in this case a key
//            if(in_array($code,$array_keys))
// {
//                $_ENV['status']= "<div class='alert alert-info' style='color:red;'>
// Product is already added to your cart!</div>";
//            }
//            else {
////                //if product keys or all keys don not exist in merge  our shopping cart session with our cart array which has values of the clicked button
//                $_SESSION["shopping_cart"] = array_merge(
//                    $_SESSION["shopping_cart"],
//                    $cartArray
//                );
//                $_ENV['status'] = "<div class='alert alert-success'>Product is added to your cart!</div>";
//            }
////
//        }
//  }
//
//}
//
function products()
{
    $status = $_ENV['status'];
    global $connection;
    $ssql = "SELECT * from products";

    $ssql_exec = mysqli_query($connection, $ssql);
    if ($ssql_exec->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($ssql_exec)) {
            $id = $row['id'];
            $code = $row["code"];
            $img = $row["image"];
            $name = $row["name"];
            $price = $row["price"];

            echo "<div class='col-xs-12  col-md-4 text-center item'>
            <form method='post'  id='productForm'>
                <div class='image'><img src=$img  /></div>
                <div class='name'>$name</div>
                <div class='price'>$$price</div>
                ";
//            echo "<small id='status' style='margin-bottom: 3px'></small>";
            echo " 
               <input type='hidden'  class='code' name='code' value=$code />
 <button type='submit' class='btn btn-info buy' id='buy'>Buy Now</button>
            </form>
</div>

";
        }
    }
}

?>