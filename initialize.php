<?php
//if(isset())
foreach($_SESSION['shopping_cart'] as $details){
    $c_name=$details['customer_name'];
    $c_email=$details['customer_email'];
}
$curl = curl_init();

$email =$c_name;
$amount = 30000;  //the amount in kobo. This value is actually NGN 300

// url to go to after payment
$callback_url = 'order_review.php';

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode([
        'amount'=>$amount,
        'email'=>$email,
        'callback_url' => $callback_url
    ]),
    CURLOPT_HTTPHEADER => [
        "authorization: Bearer sk_test_6f9b84948d4c00215106df469b812b55ed80fc5f", //replace this with your own test key
        "content-type: application/json",
        "cache-control: no-cache"
    ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
    die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx['status']){
    // there was an error from the API
    print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page
print_r($tranx);
// redirect to page so User can pay
// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);
