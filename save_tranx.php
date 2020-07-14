<?php
include ("dbconnection.php");
if(isset($_POST['reference']) && !empty($_POST['reference']) && isset($_POST['amount']) && !empty($_POST['amount']) && isset($_POST['email']) && !empty($_POST['email'])) {
    $ref = $_POST['reference'];
    $amount = $_POST['amount'];
    $email = $_POST['email'];
    $date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO `transactions` (`tranx_ref`, `amount_paid`, `customer_email`, `date_created`) VALUES ('{$ref}','{$amount}','{$email}','{$date}')";
    $sql_exec = mysqli_query($connection, $sql);
    if ($sql_exec) {
        unset($_SESSION["shopping_cart"]);
        echo(json_encode(array("success" => 'Recorded')));
    } else {
        echo(json_encode(array('error' => "error")));
    }
}else {
    echo(json_encode(array('error' => "error")));
}
?>