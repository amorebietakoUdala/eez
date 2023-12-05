<?php

namespace App\Controller;

use App\Controller\BaseController;
use App\Entity\Deduction;
use App\Entity\Quota;
use App\Entity\RGI;
use App\Form\QuotaSearchType;
use App\Form\QuotaType;
use App\Repository\DeductionRepository;
use App\Repository\QuotaRepository;
use App\Repository\RGIRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Qipsius\TCPDFBundle\Controller\TCPDFController;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\SecurityBundle\Security;

#[Route(path: '/{_locale}')]
class QuotaController extends BaseController
{

    public function __construct(
        private readonly EntityManagerInterface $em, 
        private readonly QuotaRepository $repo,
        private readonly DeductionRepository $deductionRepo,
        private readonly RGIRepository $rgiRepo,
        )
    {
    }
    #[Route(path: '/quota/new', name: 'quota_new')]
    #[IsGranted('ROLE_EEZ')]
    public function new(Request $request)
    {
        $this->loadQueryParameters($request);
        $user = $this->getUser();

        $form = $this->createForm(QuotaType::class, new Quota(), [
            'validation_groups' => ['saveQuota', 'calculateQuota'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Quota $data */
            $data = $form->getData();

            $dni = $data->getDni();
            $titular = $this->repo->findOneBy(['dni' => $dni]);
            if (null !== $titular) {
                $this->addFlash('error', 'messages.existingPrincipal');

                return $this->render('quota/edit.html.twig', [
                    'form' => $form,
                    'readonly' => false,
                    'new' => true,
                ]);
            }
            $data->setCreateDate(new DateTime());
            $data->setCreatedBy($user);
            $this->em->persist($data);
            $this->em->flush();

            $this->addFlash('success', 'messages.quotaSaved');
            $form = $this->createForm(QuotaType::class, new Quota());

            return $this->render('quota/edit.html.twig', [
                'form' => $form,
                'readonly' => false,
                'new' => true,
            ]);
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form,
            'readonly' => false,
            'new' => true,
        ]);
    }

    #[Route(path: '/quota/print', name: 'quota_print', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EEZ')]
    public function print(Request $request, TCPDFController $pdfService)
    {
        $this->loadQueryParameters($request);
        $form = $this->createForm(QuotaType::class, null);

        $form->handleRequest($request);
        $quota = $form->getData();

        $path = $this->getParameter('kernel.project_dir').'/assets/images/logo.jpg';
        $type = pathinfo((string) $path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = base64_encode($data);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('quota/pdf.html.twig', [
            'quota' => $quota,
            'readonly' => true,
            'form' => $form->createView(),
            'logo' => $base64,
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
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
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
        $pdf->Output($filename . '.pdf', 'D');

        $form = $this->createForm(QuotaSearchType::class, new QuotaSearchType());

        return $this->render('quota/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/quota/{quota}/edit', name: 'quota_edit')]
    #[IsGranted('ROLE_EEZ')]
    public function edit(Request $request, Quota $quota)
    {
        $this->loadQueryParameters($request);
        $user = $this->getUser();

        $form = $this->createForm(QuotaType::class, $quota, [
            'validation_groups' => ['saveQuota', 'calculateQuota'],
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Quota $data */
            $data = $form->getData();
            $data->setLastModificationDate(new \DateTime());
            $data->setModifiedBy($user);
            $this->em->persist($data);
            $this->em->flush();
            $this->addFlash('success', 'messages.quotaSaved');
        }

        return $this->render('quota/edit.html.twig', [
            'form' => $form,
            'readonly' => false,
            'new' => false,
        ]);
    }

    #[Route(path: '/quota/{quota}/delete', name: 'quota_delete')]
    #[IsGranted('ROLE_EEZ')]
    public function delete(Request $request, Quota $quota)
    {
        $this->loadQueryParameters($request);
        $this->em->remove($quota);
        $this->em->flush();

        return $this->redirectToRoute('quota_index');
    }

    #[Route(path: '/quota/calculate', name: 'quota_calculate', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EEZ')]
    public function calculate(Request $request)
    {
        $this->loadQueryParameters($request);
        $form = $this->createForm(QuotaType::class, null, [
            'validation_groups' => ['calculateQuota'],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $error = false;
            $rgi = $this->rgiRepo->findOneBy([]);
            $deduction = $this->deductionRepo->findOneBy([]);
            if (null === $rgi) {
                $this->addFlash('error', 'messages.noRGIParametersSet');
                $error = true;
            }
            if (null === $deduction) {
                $this->addFlash('error', 'messages.noDeductionParametersSet');

                $error = true;
            }
            /** @var Quota $quota */
            $quota = $form->getData();
            if (null === $quota->getNumberOfHours() || null === $quota->getNumberOfHours()) {
                $this->addFlash('error', 'messages.numberOfHours0');
                $error = true;
            }
            if ($error) {
                return $this->render('quota/edit.html.twig', [
                    'form' => $form,
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
            'form' => $form,
            'readonly' => false,
            'new' => true,
        ]);
    }

    #[Route(path: '/quota/{quota}/calculate', name: 'quota_edit_calculate', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_EEZ')]
    public function editCalculate(Request $request, Quota $quota)
    {
        $this->loadQueryParameters($request);
        $form = $this->createForm(QuotaType::class, $quota, [
            'validation_groups' => ['calculateQuota'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Quota $quota */
            $quota = $form->getData();
            $rgi = $this->rgiRepo->findOneBy([]);
            $deduction = $this->deductionRepo->findOneBy([]);
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
            'form' => $form,
            'readonly' => false,
            'new' => false,
        ]);
    }

    #[Route(path: '/quota/{quota}', name: 'quota_show')]
    #[IsGranted('ROLE_EEZ')]
    public function show(Request $request, Quota $quota)
    {
        $this->loadQueryParameters($request);
        $form = $this->createForm(QuotaType::class, $quota);

        return $this->render('quota/edit.html.twig', [
            'form' => $form,
            'readonly' => true,
            'new' => false,
        ]);
    }

    #[Route(path: '/quota', name: 'quota_index')]
    #[IsGranted('ROLE_EEZ')]
    public function list(Request $request)
    {
        $this->loadQueryParameters($request);
        $quotas = $this->repo->findAll();

        $form = $this->createForm(QuotaSearchType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $this->repo->findByDates($data);
            $quotas = $result;
        }

        return $this->render('quota/index.html.twig', [
            'form' => $form,
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
