<?php

namespace AppBundle\Service;

use AppBundle\Entity\BuyOrder;
use AppBundle\Repository\SellOrderRepository;

/**
 * Class BuyToSellOrderFinder
 * @package AppBundle\Service
 */
class BuyToSellOrderFinder
{
    /**
     * @var SellOrderRepository
     */
    private $repository;

    /**
     * BuyToSellOrderFinder constructor.
     * @param SellOrderRepository $repository
     */
    public function __construct(SellOrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param BuyOrder $buyOrder
     * @return \AppBundle\Entity\SellOrder[]
     */
    public function find(BuyOrder $buyOrder)
    {
        return $this->repository->findByProductAndBrandAndPriceRange(
            $buyOrder->getProduct(),
            $buyOrder->getBrand(),
            $buyOrder->getMinPrice(),
            $buyOrder->getMaxPrice()
        );
    }
}