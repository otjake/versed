<?php include ("dbconnection.php");
//getting reference number afeter completion
if(!empty($_GET['reference'])){
    $ref=$_GET['reference'];
?>
    <script>
        alert('<?php echo $ref?>');
        window.location.replace('index.php');
    </script>
<?php
}?>
<?php include ("function.php")?>
<?php //include ("cartAdd.php")
//echo cartAdd();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<!--    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">-->
    <link href="fontawesome/fontawesome.min.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">    <script src="https://kit.fontawesome.com/760c3d66bf.js" crossorigin="anonymous"></script>

    <title>Title</title>

</head>

<body>
<div class="banner">
<header class="sticky-top">
    <div class="hat">
  <h1><i class="fa fa-mobile" aria-hidden="true"></i><span class="title-color">VERSED</span></h1>
    </div>
    <div class="search_my">
        <form>
            <input type="text" class="search1" placeholder="Search">
            <button class="button1" type="submit"><i class="fas fa-search"></i></button>
        </form>

    </div>
    <?php
//count with session
    if(!isset($_SESSION["shopping_cart"])) {
    $cart_count=0;
    ?>
    <div class="cart_div" >
        <a href="cart.php" ><i class="fas fa-cart-plus"></i><span class="cart_item_count"><?php echo  $cart_count ?></span></a>
    </div>
        <?php
   }else{
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
    ?>
<!--        //count with jquery so count correlated with session couunt-->

        <div class="cart_div" >
        <a href="cart.php" ><i class="fas fa-cart-plus"></i><span class="cart_item_count"><?php echo  $cart_count ?></span></a>
    </div>
<?php
    }?>
    <div class="clearfix"></div>
</header>
<div class="nav1">
    <nav class="navbar navbar-expand-lg navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Laptops</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mobiles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Accessories</a>
                </li>
                     <li class="nav-item">
                    <a class="nav-link" href="#">Gallery</a>
                </li>
                     <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

            </ul>

        </div>
    </nav>
</div>

    <!-- The slideshow -->
    <div id="slides" class="carousel slide container slider" data-ride="carousel">
        <ul class="carousel-indicators" style="border-radius: 100%">
            <li data-target="#slides" data-slide-to="0" class="active"></li>
            <li data-target="#slides" data-slide-to="1"></li>
            <li data-target="#slides" data-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div class="carousel-item active flex-caption">
                <p>It deals with jquery so note  version used</p>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Details
                </button>
            </div>
            <div class="carousel-item flex-caption">
                                <p>It deals with jquery so note  version used</p>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Details
                </button>
            </div>
            <div class="carousel-item flex-caption">
                                <p>It deals with jquery so note  version used</p>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                    Details
                </button>
            </div>
        </div>
    </div>
    <!-- The slideshow close -->
    <!-- Modal open-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Testimonies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="width: 100%">
              <img src="images\pp.jpg">
                    <small>   checking checking checking checking checking</small>
                </div>
                <div class="modal-footer">

                    </div>
            </div>
        </div>
    </div>
    <!-- Modal close -->

</div>
<div class="container product">

    <div class="heading text-center">
        <h2>PRODUCTS</h2>
    </div>
    <div class="row" >

        <?php
       echo products();
        //displaying without functiion
//        global $connection;
//        $ssql="SELECT * from products";
//        $ssql_exec=mysqli_query($connection,$ssql);
//        if($ssql_exec->num_rows>0){
//        while ($row=mysqli_fetch_assoc($ssql_exec)){
//        $code=$row["code"];
//        $img=$row["image"];
//        $name=$row["name"];
//        $price=$row["price"];
//        ?>
<!--        <div class='col-md-4  item'>-->
<!--            <form method='post' action='cartAdd.php' id="productForm">-->
<!--                <input type='text' id="code" name='code' value=--><?php //echo $code; ?><!-- />-->
<!--                <div class='image'><img src=--><?php //echo $img; ?><!-- /></div>-->
<!--                <div class='name'>--><?php //echo $name; ?><!--</div>-->
<!--                <div class='price'>$--><?php //echo $price; ?><!--</div>-->
<!--                <div>-->
<!--               <small>--><?php ////if(isset($_POST['code']) && $code==$_POST['code']){
////                     echo $status;
////                     } ?><!--</small>-->
<!--                     <small id='status'></small>-->
<!--                </div>   <button type='submit' class='btn btn-info buy'>Buy Now</button>-->
<!--            </form>-->
<!--        </div>-->
<!--    --><?php
//        }
//    }
//    ?>
<!--        <div class=\"clearfix\"></div>-->
<!---->
<!---->
</div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!--<script src="bootstrap/jquery-3.4.1.js"></script>-->
<!--<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="js/index.js"></script>
</body>

</html>