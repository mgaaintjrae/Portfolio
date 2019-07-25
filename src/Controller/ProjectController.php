<?php

namespace App\Controller;

use App\Entity\Project;
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
     * @Route("/projet/new", name="project_add")
     */
    public function add(Request $request, ObjectManager $manager)
    {
        $project = new Project();

        //On crée un formulaire 
        $form = $this->createForm(ProjectType::class, $project);

        //On manipule la requête (vérifie si il y a des POST)
        $form->handleRequest($request);

        //Réception et Validation du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            //le persist on l'utilise que pour INSERT et UPDATE (ajouter et modifier)
            $manager->persist($project);
            $manager->flush();
            //une fois l'ajout effectuer je redirige sur la liste des projets
            return $this->redirectToRoute('project');
        }

        //affichage de notre twig
        return $this->render(
            'project/add.html.twig',
            [
                'form' => $form->createView() //on crée la vue (contient tout le HTML du formulaire)
            ]

        );
    }

    /**
     * @Route("/projet/edit/{id}", name="project_edit")
     */
    public function edit()
    {

        return false;
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
