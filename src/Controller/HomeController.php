<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
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
            $data = $doctrine->getRepository(Product::class)->findAll();
            $products = "";
            foreach($data as $element)
            {
                $products=$products."<tr><td>".$element->getBrand()."</td><td>".$element->getName()."</td><td>".$element->getModel()."</td><td>".$element->getDescription()."</td></tr>";
            }
            return $this->render('pages/accueil.html.twig',array('products' => $products));
        }
        else
        {
            return $this->render('pages/home.html.twig');
        }
    }
}