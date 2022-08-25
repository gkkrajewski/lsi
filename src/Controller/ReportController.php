<?php

namespace App\Controller;

use App\Repository\ReportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    #[Route('/', name: 'app_report')]
    public function index(Request $request, ReportRepository $repository): Response
    {
        // 1598210184

        $from = '';
        $to = '';
        $place = '';
        $sortName = $request->get('sortName') ?? 'date';
        $sortDesc = $request->get('sortDesc') ?? 'ASC';
        $order = [$sortName => $sortDesc];

        if ($request->getMethod() === 'POST') {
            $from = $request->get('from');
            $to = $request->get('to');
            $place = $request->get('place');
            $placeName = $place != '' ? $place : null;

            $dateStart = $from != '' ? (new \DateTime())->setTimestamp((int) $from) : null;
            $dateEnd = $to != '' ? (new \DateTime())->setTimestamp((int) $to) : null;
            $reports = $repository->findBySearchFields($sortName, $sortDesc, $dateStart, $dateEnd, $placeName);
        } else {
            $reports = $repository->findBy([], $order);
        }

        return $this->render('report/index.html.twig', [
            'controller_name' => 'ReportController',
            'reports' => $reports,
            'from' => $from,
            'to' => $to,
            'place' => $place,
            'sortName' => $sortName,
            'sortDesc' => $sortDesc,
        ]);
    }
}
