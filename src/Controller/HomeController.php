<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController{
    public function _construct()
    {
    }
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }
    public function authentify(Request $request): Response
    {
        
        return $this->render('pages/products.html.twig');
    }
}