<?php
require 'vendor\yabacon\paystack-php\src\autoload.php';
//if(isset())
include("dbconnection.php");
$amount=$_SESSION['total_cart_amount'];
$reference="TRC".rand(1,4);
foreach($_SESSION['shopping_cart'] as &$details){
    $c_name=$details['customer_name'];
    $c_email=$details['customer_email'];

}
$paystack = new Yabacon\Paystack("sk_test_6f9b84948d4c00215106df469b812b55ed80fc5f");
try
{
    $tranx = $paystack->transaction->initialize([
        'amount'=>$amount,       // in kobo
        'email'=>$c_email,         // unique to customers
        'reference'=>$reference, // unique to transactions
    ]);
} catch(\Yabacon\Paystack\Exception\ApiException $e){
    print_r($e->getResponseObject());
    die($e->getMessage());
}

// store transaction reference so we can query in case user never comes back
// perhaps due to network issue
($tranx->data->reference);

// redirect to page so User can pay
header('Location: ' . $tranx->data->authorization_url);