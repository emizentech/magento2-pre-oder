<?php

namespace Emizentech\Preorder\Plugin;

use Magento\Quote\Model\Quote\Item;

class DefaultItem
{
    public function aroundGetItemData($subject, \Closure $proceed, Item $item)
    {
        $data = $proceed($item);
        $product = $item->getProduct();
        if($product->getAttributeText('preorder') == 'Yes'){
            $atts = [
                "preorder" => '('.__('PreorderInfo').')'
            ];    
        }else{
            $atts = [
                "preorder" => ''
            ]; 
        }
        

        return array_merge($data, $atts);
    }
}