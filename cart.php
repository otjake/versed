<?php include ("dbconnection.php")?>

<?php //include ("function.php")?>
<?php //include ("cartprocesor.php")?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
    <link href="fontawesome/fontawesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="slider/flexslider.css" type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <?php if(!empty($_SESSION["shopping_cart"])) {
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
            <h5 class="header" >YOUR ITEMS</h5>
            <div class="row">
            <div class=" col-xs-10 offset-xs-1  input-board" >

                <?php

                if(isset($_SESSION['shopping_cart'])){
                    $total_price=0;
                    ?>
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
                    foreach ($_SESSION['shopping_cart'] as $product){
                        $code=$product['code'];
                        $image=$product['image'];
                        $name=$product['name'];
                        $quantity=$product['quantity'];
                        $price=$product['price'];
                    ?>

                    <tbody>
                    <tr  class="items">
                        <td><img src='<?php echo $image; ?>'  ></td>
                       <td>
                           <div><?php echo $name; ?></div>
                            <div>
                            <form  method="post" class="reform" >
                                <input type='hidden' name='action'   class='action' value="remove" />
                                <input type='hidden' name='code' class='code' value="<?php echo $code; ?>" />
                                <button  class="remove_btn"><i class="fa fa-trash" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        </td>

                        <td>

                                    <form >
                                        <input type='hidden' class="code" name='code' value='<?php echo $code;?>' />
                                        <input type='hidden' name='action'  class='action' value="change1" />
                                        <input type="submit" value="-" class="minus" name="decrement" style=" width: 10%;">
                                    </form>
                                                               <input name="quantity" class="quantity" type="text" disabled value="<?php echo $quantity ?>" >

                                    <form >
                                        <input type='hidden' class="code" name='code' value='<?php echo $code;?>' />
                                        <input type='hidden' name='action'  class='action' value="change2" />
                                        <input type="submit" value="+" class="plus" name="increment" style="    width: 10%;">
                                    </form>

                        </td>

                        <td><?php echo $price;?></td>
                        <td class="subtotal_price"><?php echo $price * $quantity;?></td>


                    </tr>
                    <?php
                    $total_price += $price * $quantity;
                    }
                    ?>

                    <tr>
                        <td colspan="5" align="right" class="total_holder">

                           <strong>TOTAL:</strong> <strong class="total_cart_amount"><?php echo $total_price;?></strong>
                            <p><button class="btn-outline-primary  confirm"><a href="#customer">Confirm order</a></button></p>
                        </td>
                    </tr>
                    </tbody>
                    <p class="empty_cart_info"></p>
                </table>
                    <?php
                    }else{
                        echo "<div class='alert alert-danger'>Empty Cart</div>";
                    }?>
                <div style="clear:both;"></div>

                <div class="status" style="margin:10px 0px;">
                </div>
            </div>

</div>

<!--            Customer registration form-->
            <div class="col-12 customer" id="customer" style="display: none">
                <div class="msg"></div>

                <form  class="customer_form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter Name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        <input type="hidden" name="customer_code" value="<?php echo rand() ?>">

                    </div>
                    <button type="submit" class="btn btn-primary customer_btn">Submit</button>
                </form>

        </div>

            <!--            Customer registration form-->

        </div>
</div>


    <script src="bootstrap/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/cart.js"></script>
</body>
</html>