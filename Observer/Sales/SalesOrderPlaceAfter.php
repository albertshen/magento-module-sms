<?php

namespace AlbertMage\Sms\Observer\Sales;

use Magento\Framework\Event\Observer;
use AlbertMage\Sms\Model\Sender\NewOrder;

class SalesOrderPlaceAfter implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @var NewOrder
     */
    private $newOrder;

    /**
     * OrderSaveAfter constructor.
     * @param UpdateOrder $updateOrder
     * @param NewOrder $newOrder
     */
    public function __construct(
        NewOrder $newOrder
    ) {
        $this->newOrder = $newOrder;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        
        $this->newOrder->send($order);
        //var_dump(get_class_methods($order));exit;
    }


}
