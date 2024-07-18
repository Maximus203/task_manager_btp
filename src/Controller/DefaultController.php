<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(Request $request): Response
    {
        $locale = $request->getSession()->get('_locale');
        if (!$locale) {
            $locale = $request->getPreferredLanguage($request->server->get('HTTP_ACCEPT_LANGUAGE', 'fr'));
        }
        $request->getSession()->set('_locale', $locale);
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
