<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\RGI;
use App\Form\RGIType;

/**
 * @Route("/{_locale}")
 * @IsGranted("ROLE_USER")
 */
class RGIController extends BaseController
{
    /**
     * @Route("/rgi", name="rgi")
     */
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $rgi = $this->getDoctrine()->getRepository(RGI::class)->findOneBy([]);
        if (null === $rgi) {
            $rgi = new RGI();
        }
        $form = $this->createForm(RGIType::class, $rgi);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'messages.changesSaved');
        }

        return $this->render('rgi/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
