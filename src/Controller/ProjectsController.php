<?php

namespace App\Controller;

use App\Entity\Projects;
use App\Form\ProjectsType;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/projects')]
class ProjectsController extends AbstractController
{
    #[Route('/', name: 'app_projects_index', methods: ['GET'])]
    public function index(ProjectsRepository $projectsRepository): Response
    {
        return $this->render('projects/index.html.twig', [
            'projects' => $projectsRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_projects_show', methods: ['GET'])]
    public function show(Projects $project): Response
    {
        return $this->render('projects/show.html.twig', [
            'projects' => $project,
        ]);
    }
    

}
