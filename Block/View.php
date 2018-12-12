<?php

namespace Progos\CartWeightTabPDP\Block;

use Magento\Store\Model\ScopeInterface;

class View extends \Magento\Catalog\Block\Product\View
{

    public function getAjaxUrl(){
        return $this->getUrl('cartweight/index/index');
    }

    protected $checkoutCart;

    public function __construct(
        \Magento\Checkout\Model\Cart $checkoutCart,
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,

        array $data = []
    ) {
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency
        );
    }

    /*
     * Get Product Weight Unit.
     * Return : string
     * */
    public function getWeightUnit(){
        return $this->_scopeConfig->getValue(
            'general/locale/weight_unit',
            ScopeInterface::SCOPE_STORE
        );
    }
}
?>