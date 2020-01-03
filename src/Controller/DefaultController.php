<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     * @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->redirectToRoute('quota_list');
    }
}
