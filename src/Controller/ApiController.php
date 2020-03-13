<?php

namespace App\Controller;

use App\Pagination\PaginatedCollection;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * IsGranted("ROLE_USER").
 */
class ApiController extends AbstractController
{
    /**
     * @Route("/api/expedient", name="api_list_expedient")
     */
    public function listExpedient(Request $request, SerializerInterface $serializer)
    {
        $limit = $request->query->get('limit', 5);
        $offset = $request->query->get('offset', 1);
        $page = ($offset / $limit) + 1;
        $em = $this->getDoctrine()->getManager();
        $qb = $em->getRepository('App:Expedient')->findAllQueryBuilder();
        $adapter = new DoctrineORMAdapter($qb);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($limit);
        $pagerfanta->setCurrentPage($page);

        $expedients = array();
        $results = $pagerfanta->getCurrentPageResults();
        foreach ($results as $expedient) {
            $expedients[] = $expedient;
        }

        $paginatedCollection = new PaginatedCollection($expedients, $pagerfanta->getNbResults());

        $response = $serializer->serialize($paginatedCollection, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            },
        ]);

        return new Response($response, Response::HTTP_OK,
            ['content-type' => 'application/json']);
    }
}
