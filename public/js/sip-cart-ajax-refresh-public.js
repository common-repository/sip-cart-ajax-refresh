jQuery(document).ready(function(){
    initialise();
});

function initialise() {

    $ = jQuery;

    $('.qty').on('change', function(){
        form = $(this).closest('form');

        // emulates button Update cart click
        $("<input type='hidden' name='update_cart' id='update_cart' value='1'>").appendTo(form);
        
        // plugin flag
        $("<input type='hidden' name='is_wac_ajax' id='is_wac_ajax' value='1'>").appendTo(form);

        el_qty = $(this);
        // alert(el_qty);
        matches = $(this).attr('name').match(/cart\[(\w+)\]/);

        cart_item_key = matches[1];
        form.append( $("<input type='hidden' name='cart_item_key' id='cart_item_key'>").val(cart_item_key) );

        // get the form data before disable button...
        formData = form.serialize();
        
        $("input[name='update_cart']").val('Updating…').prop('disabled', true);

        $("a.checkout-button.wc-forward").addClass('disabled').html('Updating…');

        $.post( form.attr('action'), formData, function(resp) {

            el_qty.closest('.cart_item').find('.product-subtotal').html(resp.price);
            
            $('#update_cart').remove();
            $('#is_wac_ajax').remove();
            $('#cart_item_key').remove();
            $("input[name='update_cart']").val('Cart updated.').prop('disabled', true);
            $("."+resp.cart_item_key+"-quantity").html(el_qty.val());

            if( el_qty.val() <= 0 ) {
                $("."+resp.cart_item_key+"-item").hide();
            }
            
            $(".cart-subtotal").load(resp.sip_ca_url+"sub_total.php","q="+resp.path);
            $(".order-total").load(resp.sip_ca_url+"total_price.php","q="+resp.path);
            $(".cart-discount").load(resp.sip_ca_url+"discount.php","q="+resp.path);
            $("."+resp.cart_item_key+"-price").html(resp.price);
        },
        'json'
        );
    });
}

jQuery(document).ajaxComplete(function () {
    initialise();
});