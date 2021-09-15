<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Deduction;
use App\Form\DeductionType;

/**
 * @Route("/{_locale}")
 * @IsGranted("ROLE_USER")
 */
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

            $this->addFlash('success', 'messages.changesSaved');
        }

        return $this->render('deduction/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
