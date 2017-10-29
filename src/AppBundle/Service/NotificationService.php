<?php

namespace AppBundle\Service;

use AppBundle\Service\BuyToSellOrderFinder;
use AppBundle\Entity\BuyOrder;
use AppBundle\Entity\SellOrder;
use AppBundle\Entity\User;
use OldSound\RabbitMqBundle\RabbitMq\Producer;

/**
 * Class NotificationService
 * @package AppBundle\Service
 */
class NotificationService
{
    /**
     * @var BuyToSellOrderFinder
     */
    private $buyToSellOrderFinder;

    /**
     * @var Producer
     */
    private $producer;

    /**
     * @var bool
     */
    private $useRabbitMQ;

    /**
     * @var EmailNotificator
     */
    private $emailNotificator;

    /**
     * NotificationService constructor.
     * @param BuyToSellOrderFinder $buyToSellOrderFinder
     * @param Producer $producer
     * @param bool $useRabbitMQ
     */
    public function __construct(BuyToSellOrderFinder $buyToSellOrderFinder, Producer $producer, $useRabbitMQ, EmailNotificator $emailNotificator)
    {
        $this->buyToSellOrderFinder = $buyToSellOrderFinder;
        $this->producer = $producer;
        $this->useRabbitMQ = $useRabbitMQ;
        $this->emailNotificator = $emailNotificator;
    }

    /**
     * @param BuyOrder $buyOrder
     */
    public function notifySellers(BuyOrder $buyOrder)
    {
        $sellOrders = $this->buyToSellOrderFinder->find($buyOrder);

        foreach ($sellOrders as $sellOrder) {
            $this->notifySeller($sellOrder->getUser(), $sellOrder, $buyOrder);
        }
    }

    /**
     * @param User $seller
     * @param SellOrder $sellOrder
     * @param BuyOrder $buyOrder
     */
    private function notifySeller(User $seller, SellOrder $sellOrder, BuyOrder $buyOrder)
    {
        if ($this->useRabbitMQ) {
            $message = [
                'seller' => $seller,
                'sellOrder' => $sellOrder,
                'buyOrder' => $buyOrder,
            ];
            $this->producer->publish(serialize($message));
        } else {
            $this->emailNotificator->sendEmail($seller, $sellOrder, $buyOrder);
        }
    }
}