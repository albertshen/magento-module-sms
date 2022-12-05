<?php

namespace AlbertMage\Sms\Observer\Sales;

use Magento\Framework\Event\Observer;

interface SalesObserverInterface
{

    /**
     * @return string
     */
    public function getEvent();

    /**
     * @return string
     */
    public function getQueueTopic();

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer);

}