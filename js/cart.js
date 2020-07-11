$(document).ready(function () {

    // used for  minus/decreament button once item is lower than 12
function removal(){
 var action = $(this).parent().find(".action").val();
    var code = $(this).prev().val();
    var cart_item_count=parseInt($(".cart_item_count").html());
    var new_cart_item_count= (cart_item_count -1);
    var remove=$(this).parentsUntil("tbody");
    $.ajax({
        type: "POST",
        url: 'cartprocesor.php',
        data: {'action': action, 'code': code},
    }).done(function (response) {
        setTimeout(function(){
            $.ajax({
                url: 'cartprocesor.php',
                type: 'POST',
                data: {
                    total_cart_amount: "final_amount"
                },
                success: function (response) {
                    //removing item properties and
                    $(remove).fadeOut();
                    // recalculating total amount
                    $(".total_cart_amount").html(response);
                    // recalculatig total cart count
                    $(".cart_item_count").html(new_cart_item_count);
                    if(new_cart_item_count===0){
                        //message on empty cart
                        $(".empty_cart_info").html("<div class='alert-info alert-info text-center text-capitalize text-danger'>Your cart is empty,youu are being redirected to our products page</div>");
//redirecting to index page
                        setTimeout(function() {
                            window.location='index.php'
                        }, 2000);
                    }
                }
            });
        },10);
    });
}
    // Remove item from cart with remove button
$(".remove_btn").click(function (e) {
        e.preventDefault();
    var action = $(this).parent().find(".action").val();
    var code = $(this).prev().val();
    var cart_item_count=parseInt($(".cart_item_count").html());
    var new_cart_item_count= (cart_item_count -1);
    var remove=$(this).parentsUntil("tbody");
    $.ajax({
        type: "POST",
        url: 'cartprocesor.php',
        data: {'action': action, 'code': code},
    }).done(function (response) {
        setTimeout(function(){
            $.ajax({
                url: 'cartprocesor.php',
                type: 'POST',
                data: {
                    total_cart_amount: "final_amount"
                },
                success: function (response) {
                    //removing item properties and
                    $(remove).fadeOut();
                    // recalculating total amount
                    $(".total_cart_amount").html(response);
                    // recalculatig total cart count
                    $(".cart_item_count").html(new_cart_item_count);
                    if(new_cart_item_count===0){
                        //message on empty cart
                        $(".empty_cart_info").html("<div class='alert-info alert-info text-center text-capitalize text-danger'>Your cart is empty,youu are being redirected to our products page</div>");
//redirecting to index page
                        setTimeout(function() {
                            window.location='index.php'
                        }, 2000);
                    }
                }
            });
        },10);
    });        });
// });

// Adding to cart quantity
$(".plus").click(function (e) {
        e.preventDefault();
        var action = $(this).parent().find(".action").val();
        var code = $(this).parent().find(".code").val();
        var quantity = $(this).parent().prev('.quantity');
        var subtotal_price = $(this).parentsUntil("tr").next().next(".subtotal_price");
        $.ajax({
            type: "POST",
            url: 'cartprocesor.php',
            data: {'action': action, 'code': code},
        }).done(function (response) {
            $.getJSON('cartprocesor.php', {'code_with_new_qty': code}, function (response) {
                $(quantity).val(response.item_qty);
                $(subtotal_price).html(response.subtotal);
                setTimeout(function() {
                    $.ajax({
                        type: 'post',
                        url: 'cartprocesor.php',
                        data: {
                            total_cart_amount: "final_amount"
                        },
                        success: function(response) {
                            $(".total_cart_amount").html( response);
                        }
                    });
                }, 10);
            });
        });
    });

// Subtracting from cart quantity
    $(".minus").click(function (e) {
        e.preventDefault();

        //inital jquery post for item quantity deduction

        var minus=$(this);
        var action = $(this).parent().find(".action").val();
        var code = $(this).parent().find(".code").val();
        var quantity = $(this).parent().next('.quantity');
        var subtotal_price=$(this).parentsUntil("tr").next().next(".subtotal_price");
        var remove=$(this).parentsUntil("tbody");

        /// if item quantity is 12 and decrease button is clicked fade out item properrties and run remove function
        var new_quantity=$(quantity).val();
        if(new_quantity == 12){
            $(remove).fadeOut();
            removal();
        }
       //else keep reducing nomally
        $.ajax({
            type: "POST",
            url: 'cartprocesor.php',
            data: {
                'action': action,
                'code': code
                // 'quantity':quantity
            },

            //when dedudction is done at the backend to bring values of item new quantity and subtotlal it to the front using getJSON(execting json return)
        }).done(function (response) {
            $.getJSON('cartprocesor.php',{'code_with_new_qty':code},function (response) {
                $(quantity).val(response.item_qty);//geting and replacig item qty
                $(subtotal_price).html(response.subtotal);//getting and relplacing subtotal
                //ajax to get final amount
                $.ajax({
                    url:'cartprocesor.php',
                    type:'post',
                    data:{
                        total_cart_amount:"final_amount"
                    },
                    // onsucceess response would be total and broght forwarrd
                    success:function (datares) {

                        $(".total_cart_amount").html(datares);

                    }
                })
            })
        });
    });
$(".confirm").click(function (e) {
e.preventDefault();
    $(".customer").show();
    $(".confirm").remove();
})
});

// customer registration form
$(".customer_form").submit(function (e) {
e.preventDefault();
var form=$(this);
var data=$(this).serialize();
var  msg=$(".msg");
$.ajax({
    url:"cartprocesor.php",
    type:"POST",
    data:data,
    success:function (response) {
var dataResult=JSON.parse(response);
if(dataResult.error){

}else{
    $(msg).removeClass("alert alert-danger").addClass("alert alert-success");
    $(msg).text("Hope these are correct ,Name: " + dataResult.name + "  email: " + dataResult.email );
    setTimeout(function () {
        window.location='order_review.php?name='+dataResult.name +' email='+ dataResult.email;
    }, 3000);
}

    }
})
})

////Additi and subtraction with ony javascript
//             $('.plus').click(function () {
// let quantityField=$(this).prev();
//                 quantityField.val(parseInt(quantityField.val(),10) + 12);
//             });
//
// $('.minus').click(function () {
//     let quantityField = $(this).attr('input[name="quantity"]');
//     if (quantityField.val() != 12) {
//      quantityField= quantityField.val(parseInt(quantityField.val(), 10) - 12);
//     }
// });




