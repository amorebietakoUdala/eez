<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Deduction;
use App\Form\DeductionType;

class DeductionController extends AbstractController
{
    /**
     * @Route("/deduction", name="deduction")
     */
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $deduction = $this->getDoctrine()->getRepository(Deduction::class)->findOneBy([]);
        if (null === $deduction) {
            $deduction = new Deduction();
        }
        $form = $this->createForm(DeductionType::class, $deduction);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->redirectToRoute('deduction');
        }

        return $this->render('deduction/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
