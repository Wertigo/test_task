<?php

namespace AppBundle\Service;

use AppBundle\Entity\SellOrder;
use AppBundle\Entity\BuyOrder;
use AppBundle\Entity\User;

/**
 * Class EmailNotificator
 * @package AppBundle\Service
 */
class EmailNotificator
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $emailSubject;

    /**
     * @var string
     */
    private $fromEmail;

    /**
     * EmailNotificator constructor.
     * @param \Swift_Mailer $mailer
     * @param $emailSubject
     */
    public function __construct(\Swift_Mailer $mailer, $emailSubject, $fromEmail)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail(User $seller, SellOrder $sellOrder, BuyOrder $buyOrder)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject($this->emailSubject)
            ->setFrom($this->fromEmail)
            ->setTo($seller->getEmail())
            ->setBody($this->getEmailText($sellOrder, $buyOrder))
        ;
        $this->mailer->send($message);
    }

    /**
     * @param SellOrder $sellOrder
     * @param BuyOrder $buyOrder
     * @return string
     */
    private function getEmailText(SellOrder $sellOrder, BuyOrder $buyOrder)
    {
        return 'For your sell order: ' . PHP_EOL .
            $sellOrder->toString() . PHP_EOL .
            'found buy order: ' . PHP_EOL .
            $buyOrder->toString()
        ;
    }
}