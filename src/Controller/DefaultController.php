<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DefaultController extends BaseController
{
    /**
     * @Route("/", name="default")
     * @IsGranted("ROLE_EEZ")
     */
    public function index()
    {
        return $this->redirectToRoute('quota_index');
    }
}
