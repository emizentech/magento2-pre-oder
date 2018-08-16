define([
        'jquery',
        'mage/translate',
        'jquery/ui'
    ],
    function ($, $t) {
        'use strict';
        var preorder = $("input[name=isPreorder]").val();
        if(preorder == 'Yes'){
            var addCart = $t("Pre Order");
        }else{
            var addCart = $t("Add to cart");
        }
        return function (target) {
            $.widget('mage.catalogAddToCart', target, {
                options: {
                    addToCartButtonTextWhileAdding: $t('Adding...'),
                    addToCartButtonTextAdded: $t('Added'),
                    addToCartButtonTextDefault: addCart
                }
            });

            return $.mage.catalogAddToCart;
        };
    });