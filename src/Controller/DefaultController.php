<?php

namespace App\Controller;

use App\Controller\BaseController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DefaultController extends BaseController
{
    #[Route(path: '/', name: 'app_home')]
    #[IsGranted('ROLE_EEZ')]
    public function index()
    {
        return $this->redirectToRoute('quota_index');
    }
}
