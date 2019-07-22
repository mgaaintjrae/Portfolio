<?php

namespace App\Controller;


use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TwigController extends AbstractController
{
    // Création d'une variable de session
    
    /**
     *@var SessionInterface
     */
    private $session;

    
    /**
     *@var RouterInterface
     */
    private $router;


    public function __construct(SessionInterface $session, RouterInterface $router)
    {
        $this->session = $session;
        $this->router = $router;
    }


    /**
     *@Route("/blog", name="blog_index")
     */
    public function index()
    {
        //on retourne a twig la variable de session
        return $this->render('blog/index.html.twig', [
            'posts' => $this->session->get('posts'),
        ]);
    }

    /**
     *@Route("/blog/add", name="blog_add")
     */
    public function add()
    {
        //on récupère la variable de session (get)
        $posts = $this->session->get('posts');
        $id = uniqid();
        //on génère un identifiant unique avec un tableau
        $posts[$id] = [
            'title'   => 'Un titre aléatoire' . rand(1, 500),
            'text'    => 'Un texte aléatoire' . rand(1, 500),
            'id'      => $id,
            'date'    => new \DateTime(),
            'price'   => 56300.25
        ];
        //on va attribuer cette variable (set)
        $this->session->set('posts', $posts);
        //on redirige = c'est comme ci on faisait un header(Location: /....)
        return new RedirectResponse($this->router->generate('blog_index'));
    }


    /**
     *@Route("/blog/show/{id}", name="blog_show")
     */
    public function show($id)
    {
        $posts = $this->session->get('posts');

        // Si je ne trouve pas de posts (dans la variable de session) du tout ou si l'id du post que l'on veut voir n'existe pas
        if (!$posts || !isset($posts[$id])) {
            //on met fin au controlleur
            throw new NotFoundHttpException('Post non trouvé');
        }
        //par contre si le post existe on continue le programme et on génère un template
        return $this->render(
            'blog/post.html.twig',
            [
                'id'  => $id,
                'post' => $posts[$id]
            ]
        );
    }
}

