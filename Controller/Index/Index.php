<?php

namespace Progos\CartWeightTabPDP\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Context;
use Magento\Newsletter\Model\SubscriberFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $request;
    protected $checkoutCart;

    public function __construct(Context $context ,\Magento\Checkout\Model\Cart $checkoutCart  , array $data = [])
    {
        $this->checkoutCart = $checkoutCart;
        parent::__construct($context);
    }

    public function execute()
    {
        $data   = array();
        $items  = $this->checkoutCart->getQuote()->getAllItems();
        $weight = 0;
        foreach($items as $item) {
            $weight += ($item->getWeight() * $item->getQty()) ;
        }
        $resultJson                     = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $data['cartweight']             = $weight;
        $data['status']                 = true;
        $resultJson->setData($data);
        return $resultJson;
    }

    /**
     * @return bool
     */
    private function isPostRequest()
    {
        /** @var Request $request */
        $request = $this->getRequest();
        return !empty($request->getPostValue());
    }

}
