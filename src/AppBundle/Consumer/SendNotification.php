<?php

namespace AppBundle\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;
use AppBundle\Entity\SellOrder;
use AppBundle\Entity\BuyOrder;
use AppBundle\Entity\User;
use AppBundle\Service\EmailNotificator;

class SendNotification implements ConsumerInterface
{
    /**
     * @var EmailNotificator
     */
    private $emailNotificator;

    /**
     * SendNotification constructor.
     * @param EmailNotificator $emailNotificator
     */
    public function __construct(EmailNotificator $emailNotificator)
    {
        $this->emailNotificator = $emailNotificator;
    }

    /**
     * @inheritdoc
     */
    public function execute(AMQPMessage $msg)
    {
        $body = $msg->getBody();
        $body = unserialize($body);
        /** @var User $seller */
        $seller = $body['seller'];
        /** @var SellOrder $sellOrder */
        $sellOrder = $body['sellOrder'];
        /** @var BuyOrder $buyOrder */
        $buyOrder = $body['buyOrder'];
        $this->emailNotificator->sendEmail($seller, $sellOrder, $buyOrder);
    }
}