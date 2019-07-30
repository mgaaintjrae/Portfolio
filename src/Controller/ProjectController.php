<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProjectController extends AbstractController 
{
    /**
     * @Route("/projet", name="project")
     */
    public function index(ProjectRepository $repository)
    {

        //va chercher la requête pour trouver tous les projets
        $projects = $repository->findAll();

        return $this->render('project/index.html.twig', [
            'projects' => $projects
        ]);
    }


  
     /**
     * @Route("/projet/delete/{id}", name="project_delete")
     */
    public function delete(Request $request, ObjectManager $manager, Project $project)
    {
        //je retire le project
        $manager->remove($project);
        //j'approuve la suppression
        $manager->flush();

        return $this->redirectToRoute('project');
    }
}
