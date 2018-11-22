<?php
namespace App\Controller;
use App\Controller\SecurityController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
 /**
 * @Route("/login", name="security_login")
 */
 public function login(AuthenticationUtils $authenticationUtils): Response
 {
 // get the login error if there is one
 $error = $authenticationUtils->getLastAuthenticationError();
 // last username entered by the user
// $lastUsername = $authenticationUtils->getLastUsername();
 return $this->render('security/login.html.twig', [
// 'last_username' => $lastUsername,
 'error' => $error
 ]);
 }
 /**
 * La route pour se déconnecter. Elle doit seulement être déclarée. Le
*composant symfony se charge du reste
 * @Route("/logout", name="security_logout")
 */
 public function logout(): void
 {
 }
}