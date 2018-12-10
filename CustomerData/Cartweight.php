<?php

namespace Progos\CartWeightTabPDP\CustomerData;

use Magento\Customer\CustomerData\SectionSourceInterface;

class Cartweight extends \Magento\Framework\DataObject implements SectionSourceInterface
{

    protected $checkoutSession;
    protected $checkoutCart;
    protected $quote = null;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Checkout\Model\Cart $checkoutCart,
        array $data = []
    ) {
        parent::__construct($data);
        $this->checkoutSession = $checkoutSession;
        $this->checkoutCart = $checkoutCart;
    }

    public function getSectionData()
    {
        $items = $this->getQuote()->getAllItems();
        $weight = 0;
        foreach($items as $item) {
            $weight += ($item->getWeight() * $item->getQty()) ;
        }

        return [
            'cartweight' => $weight,
        ];
    }

    /**
     * Get active quote
     *
     * @return \Magento\Quote\Model\Quote
     */
    protected function getQuote()
    {
        if (null === $this->quote) {
            $this->quote = $this->checkoutSession->getQuote();
        }
        return $this->quote;
    }
}
