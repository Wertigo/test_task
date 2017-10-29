<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\SellOrder;
use AppBundle\Form\SellOrderType;

class SellOrderController extends Controller
{
    public function createAction(Request $request)
    {
        $sellOrder = new SellOrder();
        $sellOrder->setUser($this->getUser());
        $form = $this->createForm(SellOrderType::class, $sellOrder);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($sellOrder);
                $em->flush();

                return $this->redirect($this->generateUrl('fos_user_profile_show'));
            }
        }

        return $this->render('AppBundle:SellOrder:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}