<?php

namespace AlbertMage\Sms\Model;

class Cron
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var SmsSenderManagerFactory
     */
    private $senderManager;

    /**
     * @var JobChecker
     */
    private $jobChecker;

    /**
     * Cron constructor.
     * @param Logger $logger
     * @param SmsSenderManagerFactory $senderManager
     * @param JobChecker $jobChecker
     */
    public function __construct(
    ) {
    }

    /**
     * @return void
     */
    public function execute()
    {
        // Queuer->consume($queue);
    }
}
