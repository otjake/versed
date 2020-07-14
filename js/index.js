$(document).ready(function () {
//on buy button click
    $('.buy').click(function (e) {
        e.preventDefault()
        var pos=$(this).parent().find('.code').val();
        var button_content = $(this);

        $.ajax({
            url:"cartAdd.php",
            type: 'POST',
            data:{
                code:pos
            },
            success: function (response){

                var dataResult = JSON.parse(response)
                if (dataResult.error) {
                    setTimeout(function() {
                        button_content.html('<div style="color: red"><i class="fa fa-times" aria-hidden="true"></i> Already Added</div>');
                    }, 10)

                }
                if (dataResult.success) {
                    setTimeout(function() {
                        //update add to cart button with info
                        button_content.html('<div style="color: blue"><i class="fa fa-plus" aria-hidden="true"></i>Added to <i class="fa fa-shopping-cart" aria-hidden="true" style="color: #f0f0f0f0"></div>'); //change button text to added
                    }, 20);
                    //recalculating cart amount
                    var cart_item_count=parseInt($(".cart_item_count").html());
                    var new_cart_item_count=(cart_item_count +1);
                    ( $(".cart_item_count").html(new_cart_item_count));
                }
            }
        });


    });
//hidding and showing slider on small screens with navbar dropper
    $(".navbar-toggler").click(function () {
$("#slides").toggle();
    })

})