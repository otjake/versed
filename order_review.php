<?php include ("dbconnection.php")?>

<?php

if(isset($_SESSION['shopping_cart'])){
    ?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link href="fontawesome/fontawesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="slider/flexslider.css" type="text/css">
    <!-- Bootstrap CSS -->
    <!--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">-->
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">    <script src="https://kit.fontawesome.com/760c3d66bf.js" crossorigin="anonymous"></script>

    <title>ZIRA</title>
</head>
<body>
<header class="sticky-top">
    <a href="index.php">
        <div class="hat">
            <h1><i class="fa fa-mobile" aria-hidden="true"></i><span class="title-color">VERSED</span></h1>
        </div>
    </a>
    <div class="search_my">
        <form>
            <input type="text" class="search1" placeholder="Search">
            <button class="button1" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
    <?php

    if(!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        ?>
        <div class="cart_div" >
            <a href="cart.php" ><i class="fas fa-cart-plus"></i><span class="cart_item_count"><?php echo $cart_count ?></span></a>
        </div>
        <?php
    }else{
        ?>
        <div class="cart_div" >
            <a href="cart.php" ><i class="fas fa-cart-plus"></i><span>0</span></a>
        </div>
        <?php
    }
    ?>
    <div class="clearfix"></div>
</header>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-10  col-md-10  col-lg-10 offset-xs-1  offset-md-1 offset-lg-1 text-center" style="margin-top: 10%">
            <div>
                <?php
                foreach($_SESSION['shopping_cart'] as $details){
                    $c_name=$details['customer_name'];
                    $c_email=$details['customer_email'];
                }
                ?>
              <p><strong> Hi <?php  echo $c_name; ?> please review your order before payment</strong></p>
                <p><strong><i> Email: <?php  echo $c_email?></i></strong></p>
            </div>
            <h5 class="header" >YOUR ORDER</h5>
            <div class="row">
                <div class=" col-xs-10 offset-xs-1  input-board" >

                        <table class="table ">
                            <thead>
                            <tr>
                                <th >IMAGE</th>
                                <th>ITEM NAME</th>
                                <th>QUANTITY</th>
                                <th >UNIT PRICE</th>
                                <th>ITEM TOTAL</th>
                            </tr>
                            </thead>
                            <?php
                            $final_amount=0;
                            foreach ($_SESSION['shopping_cart'] as $product){
                            $code=$product['code'];
                            $image=$product['image'];
                            $name=$product['name'];
                            $quantity=$product['quantity'];
                            $price=$product['price'];
                            $customer_name=$product['customer_name'];
                            $customer_email=$product['customer_email'];
//                            $final_amount=$product['total_cart_amount'];
                            ?>

                            <tbody>
                            <tr  class="items">
                                <td><img src='<?php echo $image; ?>'  ></td>
                                <td><div><?php echo $name; ?></div>

                                </td>

                                <td>

                                    <strong><?php echo $quantity ?></strong>

                                </td>

                                <td><?php echo $price;?></td>
                                <td class="subtotal_price"><?php echo $price * $quantity;?></td>


                            </tr>
                            <?php
                            $final_amount += $price * $quantity;

                            }
                            ?>

                            <tr>
                                <td colspan="5" align="right">

                                    <strong>TOTAL:</strong> <strong class="total_cart_amount"><?php echo $final_amount;?></strong>
                                </td>
                            </tr>
                            </tbody>
                            <p class="empty_cart_info"></p>
                        </table>

                    <div style="clear:both;"></div>

                    <div class="status" style="margin:10px 0px;">
                    </div>
                </div>

            </div>

            <!--            Customer registration form-->
            <div class="col-12 customer" id="customer">
                <div class="form-submit">
<?php //  include("pay.php"); ?>

                    <form >
                        <script src="https://js.paystack.co/v1/inline.js"></script>
                        <button type="button" id="paystack" name="pay" onclick="payWithPaystack()"> Pay </button>
                    </form>
                </div>

                <div id="order_process_msg"></div>
                <div class="order_process_msg"></div>


            </div>


        </div>
    </div>
    <script src="bootstrap/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
    <script>

        function payWithPaystack() {

            var handler = PaystackPop.setup({
                key: 'pk_test_110212113ff36c5efae0a6a3ac9b6ad06af64b06',
                email: '<?php echo  $customer_email ?>',
                amount: <?php echo  $final_amount ?>00,
                metadata: {
                    custom_fields: [
                        {
                            display_name: "Mobile Number",
                            variable_name: "mobile_number",
                            value: "+2348012345678" //customer's mobile number
                        }
                    ]
                },
                callback: function(response){
                    alert('success. transaction ref is ' + response.reference);
                },
                onClose: function () {
                    //when the user close the payment modal
                    alert('Transaction cancelled');
                }
            });
            handler.openIframe(); //open the paystack's payment modal
        }
    </script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
</body>
</html>
    <?php
                    }?>