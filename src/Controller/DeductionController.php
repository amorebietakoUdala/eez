<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Deduction;
use App\Form\DeductionType;
use App\Repository\DeductionRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route(path: '/{_locale}')]
#[IsGranted('ROLE_EEZ')]
class DeductionController extends BaseController
{
    public function __construct(
        private readonly EntityManagerInterface $em, 
        private readonly DeductionRepository $repo
        )
    {
    }

    #[Route(path: '/deduction', name: 'deduction')]
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_EEZ');

        $deduction = $this->repo->findOneBy([]);
        if (null === $deduction) {
            $deduction = new Deduction();
        }
        $form = $this->createForm(DeductionType::class, $deduction);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'messages.changesSaved');
        }

        return $this->render('deduction/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
