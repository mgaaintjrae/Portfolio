<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProjectController extends AbstractController
{
    public function __construct(ProjectRepository $repository, ObjectManager $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Route("/admin", name="project_index")
     **/
    public function index()
    {
        $projects = $this->repository->findAll();
        return $this->render('admin/project/index.html.twig', compact('projects'));
    }


    /**
     * @Route("/admin/project/add", name="project_add")
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
            //Flash message
            $this->addFlash('success', 'Le projet a été ajouté avec succès');
            //une fois l'ajout effectuer je redirige sur la liste des projets
            return $this->redirectToRoute('project_index');
        }

        //affichage de notre twig
        return $this->render(
            'admin/project/add.html.twig',
            [
                'form' => $form->createView() //on crée la vue (contient tout le HTML du formulaire)
            ]
        );
    }


    /**
     * @Route("/admin/project/edit/{id}", name="project_edit", methods="GET|POST")
     */
    public function edit(Project $project, Request $request)
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();
            //Flash message
            $this->addFlash('success', 'Le projet a été modifié avec succès');
            return $this->redirectToRoute('project_index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/admin/projet/delete/{id}", name="project_delete", methods="DELETE")
     */
    public function delete(ObjectManager $manager, Project $project, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $project->getId(), $request->get('_token'))) {
            //je retire le project
            $manager->remove($project);
            //j'approuve la suppression
            $manager->flush();
            //Flash message
            $this->addFlash('success', 'Le projet a été supprimé avec succès');
            return $this->redirectToRoute('project_index');
            // return new Response('Suppression');
        }
        return $this->render('admin/project/index.html.twig', compact('projects'));
        
    }
}
