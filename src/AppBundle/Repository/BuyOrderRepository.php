<?php

namespace AppBundle\Repository;

use AppBundle\Entity\BuyOrder;

/**
 * BuyOrderRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BuyOrderRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @param string $product
     * @param string $brand
     * @param double $price
     * @return BuyOrder[]
     */
    public function findByProductAndBrandAndPrice($product, $brand, $price)
    {
        $qb = $this->createQueryBuilder('o')
            ->select(['o', 'u'])
            ->join('o.user', 'u')
            ->andWhere('o.product = :product')
            ->andWhere('o.brand = :brand')
            ->andWhere('o.minPrice <= :price')
            ->andWhere('o.maxPrice >= :price')
            ->setParameters([
                'product' => $product,
                'brand' => $brand,
                'price' => $price,
            ])
        ;

        return $qb->getQuery()->getResult();
    }
}
