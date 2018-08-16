<?php
namespace Emizentech\PreorderPartialPayment\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SalesQuoteCollectTotalsBefore implements ObserverInterface
{

    public function execute(EventObserver $observer)
    { 
        $quote = $observer->getEvent()->getQuote();
		$quote->getShippingAddress()->setFreeShipping(true);
		$quote->save();
    }
}