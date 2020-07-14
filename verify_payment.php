<?php
require 'vendor\yabacon\paystack-php\src\autoload.php';
//if(isset())
include("dbconnection.php");


$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
    die('No reference supplied');
}

// initiate the Library's Paystack Object
$paystack = new Yabacon\Paystack("sk_test_6f9b84948d4c00215106df469b812b55ed80fc5f");
try
{
    // verify using the library
    $tranx = $paystack->transaction->verify([
        'reference'=>$reference, // unique to transactions
    ]);
} catch(\Yabacon\Paystack\Exception\ApiException $e){
    print_r($e->getResponseObject());
    die($e->getMessage());
}
//var_dump($tranx);//this gives you the object model returned
if ('success' === $tranx->data->status) {
    if ($reference === $tranx->data->reference) {
        $amount = ($tranx->data->amount);
        $amount = $amount / 100;//paystack uses kobo base si unit

        echo(json_encode(array('reference' => $tranx->data->reference, 'amount' => $amount, 'c_email' => $tranx->data->customer->email)));
    }else{
        echo(json_encode(array('error' => "Payment Error")));

    }
}
else{
    echo(json_encode(array('error' => "Payment Error")));

}