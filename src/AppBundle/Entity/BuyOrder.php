<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BuyOrder
 *
 * @ORM\Table(name="buy_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BuyOrderRepository")
 */
class BuyOrder
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="product", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Please fill product")
     */
    private $product;

    /**
     * @var double
     *
     * @ORM\Column(name="min_price", type="decimal", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank(message="Please fill min price")
     */
    private $minPrice;

    /**
     * @var double
     *
     * @ORM\Column(name="max_price", type="decimal", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank(message="Please fill max price")
     */
    private $maxPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Please fill brand")
     */
    private $brand;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="buyOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="No user selected")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $product
     * @return BuyOrder
     */
    public function setProduct($product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * @return string
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param string $minPrice
     * @return BuyOrder
     */
    public function setMinPrice($minPrice)
    {
        $this->minPrice = $minPrice;

        return $this;
    }

    /**
     * @return string
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }

    /**
     * @param string $maxPrice
     * @return BuyOrder
     */
    public function setMaxPrice($maxPrice)
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * Get maxPrice
     *
     * @return string
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }

    /**
     * @param \AppBundle\Entity\User $user
     * @return BuyOrder
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return BuyOrder
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'Product: ' . $this->getProduct() . ', brand: ' . $this->getBrand() . ', min price: ' .
            $this->getMinPrice() . ', max price: ' . $this->getMaxPrice()
        ;
    }
}
