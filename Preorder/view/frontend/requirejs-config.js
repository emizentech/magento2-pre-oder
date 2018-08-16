var config = {
    config: {
        mixins: {
            'Magento_Catalog/js/catalog-add-to-cart': {
                'Emizentech_Preorder/js/catalog-add-to-cart-mixin': true
            }
        }
    },
    map: {
        '*': {
            'Magento_Checkout/template/minicart/item/default.html':
                'Emizentech_Preorder/template/minicart/item/default.html',
        }
    }
};