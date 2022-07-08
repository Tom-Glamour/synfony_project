<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;

class CreateAccountController extends AbstractController{
    public function _construct()
    {
    }
    public function index(): Response
    {
        return $this->render('pages/createAccount.html.twig');
    }
    public function create(ManagerRegistry $doctrine,Request $request): Response
    {
        $existing_user = $doctrine->getRepository(User::class)->findOneBy(['name' => $request->request->get('userName')]);
        if($existing_user || $request->request->get('password')!=$request->request->get('password2'))
        {
            return $this->render('pages/createAccount.html.twig');
        }
        else
        {
            $entityManager = $doctrine->getManager();
            $user = new User();
            $user->setName($request->request->get('firstName'));
            $user->setSurname($request->request->get('lastName'));
            $user->setEmail($request->request->get('email'));
            $user->setAddress($request->request->get('address'));
            $user->setUsername($request->request->get('userName'));
            $user->setPassword($request->request->get('password'));


            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($user);

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            return $this->render('pages/home.html.twig');

        }
    }
}