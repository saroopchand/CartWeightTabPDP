<?php

namespace Progos\CartWeightTabPDP\Block;

use Magento\Store\Model\ScopeInterface;

class View extends \Magento\Catalog\Block\Product\View
{
    /*
     * Get Total Cart Weight.
     * Return : String
     * Description : Get Cart Detail by Object Manager Design Pattern.
     * */
    public function getTotalCartWeight(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        $items = $cart->getQuote()->getAllItems();

        $weight = 0;
        foreach($items as $item) {
            $weight += ($item->getWeight() * $item->getQty()) ;
        }

        return $weight;
    }

    /*
     * Get Product Weight Unit.
     * Return : string
     * */
    public function getWeightUnit()
    {
        return $this->_scopeConfig->getValue(
            'general/locale/weight_unit',
            ScopeInterface::SCOPE_STORE
        );
    }
}
?>