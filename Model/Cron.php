<?php

namespace AlbertMage\Sms\Model;

use AlbertMage\Sms\Model\SmsSalesQueueManager;

class Cron
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var SmsSalesQueueManager
     */
    protected $smsSalesQueueManager;

    /**
     * Cron constructor.
     * @param Logger $logger
     * @param SmsSalesQueueManager $smsSalesQueueManager
     */
    public function __construct(
        SmsSalesQueueManager $smsSalesQueueManager
    ) {
        $this->smsSalesQueueManager = $smsSalesQueueManager;
    }

    /**
     * @return void
     */
    public function execute()
    {
        $items = $this->smsSalesQueueManager->getPendingQueue([1])->getItems();
        if ($items) {
            $this->smsSalesQueueManager->batchConsume($items);
        }
        
    }
}
