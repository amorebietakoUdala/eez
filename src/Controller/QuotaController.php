<?php

namespace App\Controller;

use App\Entity\Deduction;
use App\Entity\Quota;
use App\Entity\RGI;
use App\Form\QuotaSearchType;
use App\Form\QuotaType;
use DateTime;
use Qipsius\TCPDFBundle\Controller\TCPDFController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * @Route("/{_locale}")
 */
class QuotaController extends AbstractController
{
    /**
     * @Route("/quota/new", name="quota_new")
     * @IsGranted("ROLE_USER")
     */
    public function new(Request $request, Security $security)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $security->getUser();

        $form = $this->createForm(QuotaType::class, new Quota(), [
            'validation_groups' => ['saveQuota', 'calculateQuota'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Quota $data */
            $data = $form->getData();

            $dni = $data->getDni();
            $titular = $em->getRepository(Quota::class)->findOneBy(['dni' => $dni]);
            if (null !== $titular) {
                $this->addFlash('error', 'messages.existingPrincipal');

                return $this->render('quota/edit.html.twig', [
                    'form' => $form->createView(),
                    'readonly' => false,
                    'new' => true,
                ]);
            }
            $data->setCreateDate(new DateTime());
            $data->setCreatedBy($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();

            $this->addFlash('success', 'messages.quotaSaved');
            $form = $this->createForm(QuotaType::class, new Quota());

            return $this->render('quota/edit.html.twig', [
                'form' => $form->createView(),
                'readonly' => false,
                'new' => true,
            ]);
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
            'new' => true,
        ]);
    }

    /**
     * @Route("/quota/print", name="quota_print", methods={"GET","POST"})
     * @IsGranted("ROLE_USER")
     */
    public function print(Request $request, TCPDFController $pdfService)
    {
        $form = $this->createForm(QuotaType::class, null);

        $form->handleRequest($request);
        $quota = $form->getData();
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('quota/pdf.html.twig', [
                    'quota' => $quota,
                    'readonly' => true,
                    'form' => $form->createView(),
                ]);

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
        $filename = 'quota';
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
        $pdf->Output($filename.'.pdf', 'D');

        $form = $this->createForm(QuotaSearchType::class, new QuotaSearchType());

        return $this->render('quota/list.html.twig', [
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/quota/{quota}/edit", name="quota_edit")
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Quota $quota, Security $security)
    {
        $user = $security->getUser();

        $form = $this->createForm(QuotaType::class, $quota, [
            'validation_groups' => ['saveQuota', 'calculateQuota'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Quota $data */
            $data = $form->getData();
            $data->setLastModificationDate(new \DateTime());
            $data->setModifiedBy($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success', 'messages.quotaSaved');
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
            'new' => false,
        ]);
    }

    /**
     * @Route("/quota/{quota}/delete", name="quota_delete")
     * @IsGranted("ROLE_USER")
     */
    public function delete(Quota $quota)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($quota);
        $em->flush();

        return $this->redirectToRoute('quota_list');
    }

    /**
     * @Route("/quota/calculate", name="quota_calculate", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function calculate(Request $request)
    {
        $form = $this->createForm(QuotaType::class, null, [
            'validation_groups' => ['calculateQuota'],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $error = false;
            $rgi = $this->getDoctrine()->getRepository(RGI::class)->findOneBy([]);
            $deduction = $this->getDoctrine()->getRepository(Deduction::class)->findOneBy([]);
            if (null === $rgi) {
                $this->addFlash('error', 'messages.noRGIParametersSet');
                $error = true;
            }
            if (null === $deduction) {
                $this->addFlash('error', 'messages.noDeductionParametersSet');

                $error = true;
            }
            /*@var $quota Quota */
            $quota = $form->getData();
            if (null === $quota->getNumberOfHours() || null === $quota->getNumberOfHours()) {
                $this->addFlash('error', 'messages.numberOfHours0');
                $error = true;
            }
            if ($error) {
                return $this->render('quota/edit.html.twig', [
                    'form' => $form->createView(),
                    'readonly' => false,
                    'new' => true,
                    ]);
            }

            $calculatedQuota = $this->__calculateQuota($quota, $rgi, $deduction);
            $form = $this->createForm(QuotaType::class, $calculatedQuota, [
                'validation_groups' => ['calculateQuota'],
            ]);
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
            'new' => true,
        ]);
    }

    /**
     * @Route("/quota/{quota}/calculate", name="quota_edit_calculate", methods={"GET", "POST"})
     * @IsGranted("ROLE_USER")
     */
    public function editCalculate(Request $request, Quota $quota)
    {
        $form = $this->createForm(QuotaType::class, $quota, [
            'validation_groups' => ['calculateQuota'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*@var $quota Quota */
            $quota = $form->getData();
            $rgi = $this->getDoctrine()->getRepository(RGI::class)->findOneBy([]);
            $deduction = $this->getDoctrine()->getRepository(Deduction::class)->findOneBy([]);
            $calculatedQuota = $this->__calculateQuota($quota, $rgi, $deduction);
            $form = $this->createForm(QuotaType::class, $calculatedQuota, [
                'validation_groups' => ['calculateQuota'],
            ]);
            if (null === $rgi) {
                $this->addFlash('error', 'messages.noRGIParametersSet');
            }
            if (null === $deduction) {
                $this->addFlash('error', 'messages.noDeductionParametersSet');
            }
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => false,
            'new' => false,
        ]);
    }

    /**
     * @Route("/quota/{quota}", name="quota_show")
     * @IsGranted("ROLE_USER")
     */
    public function show(Quota $quota)
    {
        $form = $this->createForm(QuotaType::class, $quota);

        return $this->render('quota/edit.html.twig', [
            'form' => $form->createView(),
            'readonly' => true,
            'new' => false,
        ]);
    }

    /**
     * @Route("/quota", name="quota_list")
     * @IsGranted("ROLE_USER")
     */
    public function list(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $quotas = $em->getRepository('App:Quota')->findAll();

        $form = $this->createForm(QuotaSearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $em->getRepository('App:Quota')->findByDates($data);
            $quotas = $result;
        }

        return $this->render('/quota/list.html.twig', [
            'form' => $form->createView(),
            'quotas' => $quotas,
        ]);
    }

    public function __calculateQuota(Quota $quota, RGI $rgi, Deduction $deduction)
    {
        $quota->setBonuses($deduction, $quota->getMembers());
        $quota->setTotalHouseholdIncome(
            round($quota->calculateTotalHouseholdIncome(), 2)
        );
        $quota->setEquityIncrease(
            round($quota->calculateEquityIncrease($rgi), 2)
        );
        $quota->setMonthlyContribution(
            round($quota->calculateMonthlyContribution($deduction, $rgi), 2)
        );
        $quota->setPricePerHour(
            round($quota->calculatePricePerHour($deduction, $rgi), 2)
        );

        return $quota;
    }
}
