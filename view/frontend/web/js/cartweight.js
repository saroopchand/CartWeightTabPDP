define([
    "jquery",
    "jquery/ui"
], function($){
    "use strict";

    function main(config, element) {
        $(document).ready(function(){
            callAjax(config, element);
            $('#product-addtocart-button').on('click',function(){
                addUpdateAction( config, element )
            });

            $('.update-cart-item').on('click',function(){
                addUpdateAction( config, element )
            });

        });
    };

    function addUpdateAction( config, element ){
        $(document).ajaxComplete(function (event, xhr, settings) {
            if (settings.url.indexOf("customer/section/load/?sections=cart") > 0) {
                var cartObj = xhr.responseJSON;
                if( cartObj.cart.summary_count > 0 ){
                    callAjax(config, element);
                }
            }
        });
    }

    function callAjax( config, element ){
        var $element = $(element);
        var AjaxUrl = config.AjaxUrl;
        var weightUnit = config.weightUnit;
        var currentProductWeight = config.currentProductWeight;

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
    };
    return main;
});