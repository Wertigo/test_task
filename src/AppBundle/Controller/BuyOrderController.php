<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\BuyOrder;
use AppBundle\Form\BuyOrderType;

class BuyOrderController extends Controller
{
    public function createAction(Request $request)
    {
        $buyOrder = new BuyOrder();
        $buyOrder->setUser($this->getUser());
        $form = $this->createForm(BuyOrderType::class, $buyOrder);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($buyOrder);
                $em->flush();
                /** @var \AppBundle\Service\NotificationService $notificationService */
                $notificationService = $this->container->get('app.notificator');
                $notificationService->notifySellers($buyOrder);

                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return $this->render('AppBundle:BuyOrder:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}