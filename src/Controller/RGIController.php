<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\RGI;
use App\Form\RGIType;
use App\Repository\RGIRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route(path: '/{_locale}')]
#[IsGranted('ROLE_EEZ')]
class RGIController extends BaseController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly RGIRepository $repo,
        )
    {
    }

    #[Route(path: '/rgi', name: 'rgi')]
    public function edit(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_EEZ');

        $rgi = $this->repo->findOneBy([]);
        if (null === $rgi) {
            $rgi = new RGI();
        }
        $form = $this->createForm(RGIType::class, $rgi);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'messages.changesSaved');
        }

        return $this->render('rgi/edit.html.twig', [
            'form' => $form,
        ]);
    }
}
