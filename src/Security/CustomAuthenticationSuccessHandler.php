<?php

namespace App\Security;

use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Psr\Log\LoggerInterface;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private $router;
    private $logger;


    public function __construct(RouterInterface $router, LoggerInterface $logger)
    {
        $this->router = $router;
        $this->logger = $logger;

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();

        if ($user instanceof UserInterface) {
            var_dump('User roles:', $user->getRoles());

            if (in_array('ROLE_ADMIN', $user->getRoles())) {
                var_dump('Redirecting to admin dashboard');
                return new RedirectResponse($this->router->generate('admin'));
            } elseif (in_array('ROLE_COLLABORATOR', $user->getRoles())) {
                var_dump('Redirecting to collaborateur dashboard');
                return new RedirectResponse($this->router->generate('colab_dashboard'));
            }
        }

        var_dump('Redirecting to homepage');
        return new RedirectResponse($this->router->generate('index'));
    }
}
