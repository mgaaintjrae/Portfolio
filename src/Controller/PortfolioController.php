<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PortfolioController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        
        return $this->render('index.html.twig');

    }

    /**
     * @Route("/about", name="a-propos")
     */
    // public function about()
    // {
    //     return new Response(
    //         '<html><body>Page about</body></html>'
    //     );
    // }
}