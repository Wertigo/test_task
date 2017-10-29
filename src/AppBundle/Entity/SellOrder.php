<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * BuyOrder
 *
 * @ORM\Table(name="sell_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SellOrderRepository")
 */
class SellOrder
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
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     * @Assert\NotBlank(message="Please fill price")
     */
    private $price;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="sellOrders")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * @Assert\NotBlank(message="No user selected")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Please fill brand")
     */
    private $brand;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $product
     * @return SellOrder
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
     * @param string $price
     * @return SellOrder
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param \AppBundle\Entity\User $user
     * @return SellOrder
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
     * @return SellOrder
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
        return 'Product: ' . $this->getProduct() . ', brand: ' . $this->getBrand() . ', price: ' . $this->getPrice();
    }
}
