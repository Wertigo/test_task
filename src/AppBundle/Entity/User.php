<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     * @Assert\NotBlank(message="Please choose user type", groups={"Registration"})
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="BuyOrder", mappedBy="user")
     */
    private $buyOrders;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SellOrder", mappedBy="user")
     */
    private $sellOrders;

    /**
     * @var int
     */
    const TYPE_CLIENT = 1;

    /**
     * @var int
     */
    const TYPE_SELLER = 2;

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->buyOrders = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\BuyOrder $buyOrder
     * @return User
     */
    public function addBuyOrder(\AppBundle\Entity\BuyOrder $buyOrder)
    {
        $this->buyOrders[] = $buyOrder;

        return $this;
    }

    /**
     * @param \AppBundle\Entity\BuyOrder $buyOrder
     * @return User
     */
    public function removeBuyOrder(\AppBundle\Entity\BuyOrder $buyOrder)
    {
        $this->buyOrders->removeElement($buyOrder);

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBuyOrders()
    {
        return $this->buyOrders;
    }

    /**
     * Add sellOrder
     *
     * @param \AppBundle\Entity\SellOrder $sellOrder
     *
     * @return User
     */
    public function addSellOrder(\AppBundle\Entity\SellOrder $sellOrder)
    {
        $this->sellOrders[] = $sellOrder;

        return $this;
    }

    /**
     * Remove sellOrder
     *
     * @param \AppBundle\Entity\SellOrder $sellOrder
     * @return User
     */
    public function removeSellOrder(\AppBundle\Entity\SellOrder $sellOrder)
    {
        $this->sellOrders->removeElement($sellOrder);

        return $this;
    }

    /**
     * Get sellOrders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSellOrders()
    {
        return $this->sellOrders;
    }

    /**
     * @return bool
     */
    public function isClient()
    {
        return $this->type === self::TYPE_CLIENT;
    }

    /**
     * @return bool
     */
    public function isSeller()
    {
        return $this->type === self::TYPE_SELLER;
    }
}
