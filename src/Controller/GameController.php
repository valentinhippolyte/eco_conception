<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Imagine\Image\Box;
use Imagine\Gd\Imagine;

#[Route('/game', name: 'app_game')]
class GameController extends AbstractController
{
    #[Route('/', name: '_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        // Only the last 5 games
        $games = $gameRepository->findBy([], ['createdAt' => 'DESC'], 5);

        return $this->render('game/index.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    public function compressImage($file, $name)
    {
        $imagine = new Imagine();
        $image = $imagine->open($file->getPathname());

        $size = $image->getSize();
        $ratio = $size->getWidth() / $size->getHeight();
        $newHeight = 720;
        $newWidth = $newHeight * $ratio;

        $image->resize(new Box($newWidth, $newHeight));

        $uploadsDir = $this->getParameter('uploads_directory');
        $newFilename = $name . '.' . $file->guessExtension();

        $image->save($uploadsDir . '/' . $newFilename);

        return $newFilename;
    }
}
