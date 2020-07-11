<!-- place below the html form -->
<?php
foreach ($_SESSION['shopping_cart'] as $details){
    $email=$details['customer_email'];
    $c_name=$details['customer_name'];
}
if (isset($_SESSION["shopping_cart"]) && count($_SESSION["shopping_cart"]) > 0) { //if we have session variable
    $total_dec = 0;
    foreach ($_SESSION["shopping_cart"] as $key=>$value ) { //loop though items and prepare html content

        $product_price = $_SESSION["shopping_cart"][$key]['price'];
        $product_code =$_SESSION["shopping_cart"][$key]['code'];
        $product_qty = $_SESSION["shopping_cart"][$key]['quantity'];
        $subtotal_dec = ($product_price * $product_qty);
        $total_dec = ($total_dec + $subtotal_dec);
    }



    $amount = ($total_dec) * 100;
}


 ?>
<script>
    function payWithPaystack(){
        var handler = PaystackPop.setup({
            key: 'pk_test_110212113ff36c5efae0a6a3ac9b6ad06af64b06',
            email: '<?php echo  $email ?>',
            amount: <?php echo  $amount ?>00,
            metadata: {
                custom_fields: [
                    {
                        display_name: "Mobile Number",
                        variable_name: "mobile_number",
                        value: "+2348012345678" //customer's mobile number
                    }
                ]
            },
            callback: function (response) {
                //after the transaction have been completed
                //make post call  to the server with to verify payment
                //using transaction reference as post data
                $.post("verify.php", {reference:response.reference}, function(status){
                    if(status == "success")
                        //successful transaction
                        alert('Transaction was successful');
                    else
                        //transaction failed
                        alert(response);
                });
            },
            onClose: function () {
                //when the user close the payment modal
                alert('Transaction cancelled');
            }
        });
        handler.openIframe(); //open the paystack's payment modal
    }
</script>