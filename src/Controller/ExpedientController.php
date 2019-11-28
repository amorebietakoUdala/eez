<?php

namespace App\Controller;

use App\Entity\Expedient;
use App\Form\ExpedientSearchType;
use App\Form\ExpedientType;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use WhiteOctober\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\HttpFoundation\Response;

class ExpedientController extends AbstractController
{
    /**
     * @Route("/expedient/new", name="expedient_new")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, Security $security)
    {
//        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $security->getUser();

        $form = $this->createForm(ExpedientType::class, new Expedient());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Expedient $data */
            $data = $form->getData();
            $data->setCreateDate(new DateTime());
            $data->setCreatedBy($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'messages.expedientSaved');
            $form = $this->createForm(ExpedientType::class, new Expedient());

            return $this->render('expedient/edit.html.twig', [
                'form' => $form->createView(),
                'readonly' => false,
            ]);
        }

        return $this->render('expedient/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
        ]);
    }

    /**
     * @Route("/expedient/print", name="expedient_print", methods={"POST"})
     * @IsGranted("ROLE_USER")
     */
    public function print(Request $request, TCPDFController $pdfService)
    {
        $form = $this->createForm(ExpedientType::class, new Expedient());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $expedient = $form->getData();
            // Retrieve the HTML generated in our twig file
            $html = $this->renderView('expedient/pdf.html.twig', [
                    'expedient' => $expedient,
                    'readonly' => true,
                    'form' => $form->createView(),
                ]);

//            return new Response($html);
            $pdf = $pdfService->create(
                'vertical',
                PDF_UNIT,
                PDF_PAGE_FORMAT,
                true,
                'UTF-8',
                false
            );
            $pdf->SetMargins(PDF_MARGIN_LEFT, 5, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(0);
            $pdf->SetFooterMargin(0);
            $pdf->SetAutoPageBreak(true, 0);
            $pdf->SetAuthor('Amorebitako-Etxanoko Udala');
            $pdf->SetTitle('Errolda Ziurtagiria');
            $pdf->SetSubject('Errolda Ziurtagiria');
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(true);
            $pdf->setFontSubsetting(true);
            $pdf->SetFont('helvetica', '', 11, '', true);
            $pdf->AddPage();
            $filename = 'expedient';
            $pdf->writeHTMLCell(
                $w = 0,
                $h = 0,
                $x = '',
                $y = '',
                $html,
                $border = 0,
                $ln = 1,
                $fill = 0,
                $reseth = false,
                $align = '',
                $autopadding = true
            );
            $pdf->Output($filename.'.pdf', 'I');

            $form = $this->createForm(ExpedientSearchType::class, new ExpedientSearchType());

            return $this->render('expedient/list.html.twig', [
                'form' => $form->createView(),
            ]);
        }

        return $this->render('expedient/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => true,
        ]);
    }

    /**
     * @Route("/expedient/{expedient}/edit", name="expedient_edit")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Expedient $expedient, Security $security)
    {
        $user = $security->getUser();

        $form = $this->createForm(ExpedientType::class, $expedient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Expedient $data */
            $data = $form->getData();
            $data->setLastModificationDate(new DateTime());
            $data->setModifiedBy($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
        }

        return $this->render('expedient/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
        ]);
    }

    /**
     * @Route("/expedient/{expedient}/delete", name="expedient_delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete(Request $request, Expedient $expedient)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($expedient);
        $em->flush();

        return $this->redirectToRoute('expedient_list');
    }

    /**
     * @Route("/expedient/{expedient}", name="expedient_show")
     * @IsGranted("ROLE_USER")
     */
    public function show(Request $request, Expedient $expedient)
    {
        $form = $this->createForm(ExpedientType::class, $expedient);

        return $this->render('expedient/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => true,
        ]);
    }

    /**
     * @Route("/expedient", name="expedient_list")
     * @IsGranted("ROLE_USER")
     */
    public function list(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $expedients = $em->getRepository('App:Expedient')->findAll();

        $form = $this->createForm(ExpedientSearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $em->getRepository('App:Expedient')->findByDates($data);
            $expedients = $result;
        }

        return $this->render('/expedient/list.html.twig', [
            'form' => $form->createView(),
            'expedients' => $expedients,
        ]);
    }
}
