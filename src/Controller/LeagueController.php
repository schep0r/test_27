<?php

namespace App\Controller;

use App\Entity\League;
use App\Repository\LeagueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LeagueController extends AbstractController
{
    #[Route('/leagues', name: 'app_league_index')]
    public function index(Request $request, LeagueRepository $leagueRepository): JsonResponse
    {
        $startTime = $request->query->get('start_timestamp');
        $leagueIds = $leagueRepository->findAllIds($startTime);

        return new JsonResponse($leagueIds);
    }

    #[Route('/leagues/{leagueId}', name: 'app_league_show')]
    public function show(LeagueRepository $leagueRepository, int $leagueId): JsonResponse
    {
        $league = $leagueRepository->findOneBy(['sourceLeagueId' => $leagueId]);

        if (!$league) {
            return new JsonResponse(["message" => 'League not found'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(["name" => $league->getName()]);
    }
}
