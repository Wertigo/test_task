<?php

namespace AppBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;

class ProfileController extends BaseController
{
    /**
     * Show the user.
     */
    public function showAction()
    {
        /** @var \AppBundle\Entity\User $user */
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $comparedBuyOrders = [];

        if ($user->isSeller()) {
            /** @var \AppBundle\Service\SellToBuyOrderFinder $sellToBuyOrderComparer */
            $sellToBuyOrderComparer = $this->container->get('app.sell_to_buy_order_comparer');
            $comparedBuyOrders = $sellToBuyOrderComparer->find($user->getSellOrders()->toArray());
        }

        return $this->render('@FOSUser/Profile/show.html.twig', [
            'user' => $user,
            'comparedBuyOrders' => $comparedBuyOrders,
        ]);
    }
}