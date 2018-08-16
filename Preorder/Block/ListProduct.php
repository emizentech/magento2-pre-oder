<?php
namespace Emizentech\Preorder\Block;
use Magento\Framework\View\Element\Template;
class ListProduct extends \Magento\Catalog\Block\Product\ListProduct{


/*public function getText($_product)
{
    $preDate = $_product->getResource()->getAttribute('availability_date')->getFrontend()->getValue($_product);
    $_ct= new Zend_Date($preDate); 
    $currentDate = (new \DateTime());
    $cdate = strtotime($currentDate->format('Y-m-d'));
    $availdate = strtotime($_ct->toString('Y-MM-dd'));
    if($availdate > $cdate){
        return true;
    }
}

public function getTimeAccordingToTimeZone($dateTime)
    {
        // for get current time according to time zone
        $today = $this->_timezoneInterface->date()->format('m/d/y H:i:s');
 
        // for convert date time according to magento time zone
        $dateTimeAsTimeZone = $this->_timezoneInterface
                                        ->date(new \DateTime($dateTime))
                                        ->format('m/d/y H:i:s');
        return $dateTimeAsTimeZone;
    }
*/
}