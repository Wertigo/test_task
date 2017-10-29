<?php

namespace AppBundle\Service;

use AppBundle\Entity\SellOrder;
use AppBundle\Repository\BuyOrderRepository;

/**
 * Class SellToBuyOrderFinder
 * @package AppBundle\Service
 */
class SellToBuyOrderFinder
{
    /**
     * @var BuyOrderRepository
     */
    private $repository;

    /**
     * BuyToSellOrderFinder constructor.
     * @param BuyOrderRepository $repository
     */
    public function __construct(BuyOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param SellOrder[] $sellOrders
     * @return \AppBundle\Entity\BuyOrder[]
     */
    public function find(array $sellOrders)
    {
        $buyOrders = [];

        foreach ($sellOrders as $sellOrder) {
            $buyOrders = array_merge(
                $buyOrders,
                $this->repository->findByProductAndBrandAndPrice(
                    $sellOrder->getProduct(),
                    $sellOrder->getBrand(),
                    $sellOrder->getPrice()
                )
            );
        }

        return array_unique($buyOrders, SORT_REGULAR);
    }
}