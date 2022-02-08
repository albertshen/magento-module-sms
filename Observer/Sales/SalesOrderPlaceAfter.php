<?php

namespace AlbertMage\Sms\Observer\Sales;

use Magento\Framework\Event\Observer;
use Magento\Framework\App\ObjectManager;

class SalesOrderPlaceAfter implements \Magento\Framework\Event\ObserverInterface
{

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        $newOrder = ObjectManager::getInstance()->create(\AlbertMage\Sms\Model\Sender\Sales\NewOrder::class);
        $newOrder->send($order);
    }

}
