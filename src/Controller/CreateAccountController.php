<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateAccountController extends AbstractController{
    public function _construct()
    {
    }
    public function index(): Response
    {
        return $this->render('pages/createAccount.html.twig');
    }
}