<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class HomeController extends AbstractController{
    public function _construct()
    {
    }
    public function index(): Response
    {
        return $this->render('pages/home.html.twig');
    }
    public function authentify(ManagerRegistry $doctrine,Request $request): Response
    {
        $user = $doctrine->getRepository(User::class)->findOneBy(['username' => $request->request->get('user')]);
        if($user && $user->getPassword()==$request->request->get('password'))
        {
            return $this->render('pages/accueil.html.twig');
        }
        else
        {
            return $this->render('pages/home.html.twig');
        }
    }
}