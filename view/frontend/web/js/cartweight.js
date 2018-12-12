define([
    "jquery",
    "jquery/ui"
], function($){
    "use strict";

    function main(config, element) {
        var $element = $(element);
        var AjaxUrl = config.AjaxUrl;
        var weightUnit = config.weightUnit;
        var currentProductWeight = config.currentProductWeight;

        $(document).ready(function(){
            $.ajax({
                context: '#ajaxresponse',
                url: AjaxUrl,
                type: "post",
                data: {},
            }).done(function (data) {
                var afterproductaddtocart = parseFloat(currentProductWeight) + parseFloat(data.cartweight);
                $('#total-cart-weight').html("Total Cart Weight: "+data.cartweight+" "+weightUnit);
                $('#afterproductaddtocart').html("Cart Weight after this product: "+afterproductaddtocart+" "+weightUnit);
                return true;
            });
        });
    };
    return main;
});