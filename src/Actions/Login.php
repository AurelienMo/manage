<?php

declare(strict_types=1);

/*
 * This file is part of management
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Actions;

use App\Responders\ViewResponder;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class Login
 *
 * @Route("/", name="login")
 */
class Login
{
    /** @var AuthenticationUtils */
    protected $authenticationUtils;

    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /**
     * Login constructor.
     *
     * @param AuthenticationUtils   $authenticationUtils
     * @param UrlGeneratorInterface $urlGenerator
     */
    public function __construct(
        AuthenticationUtils $authenticationUtils,
        UrlGeneratorInterface $urlGenerator
    ) {
        $this->authenticationUtils = $authenticationUtils;
        $this->urlGenerator = $urlGenerator;
    }


    public function __invoke(ViewResponder $responder)
    {
        $error = $this->authenticationUtils->getLastAuthenticationError();
        $lastUsername = $this->authenticationUtils->getLastUsername();

        return $responder(
            'security/login.html.twig',
            [
                'error' => $error,
                'last_username' => $lastUsername,
                'csrf_token_intention' => 'authenticate',
                'target_path' => $this->urlGenerator->generate('easyadmin'),
                'username_label' => 'Identifiant *',
                'password_label' => 'Mot de passe *',
                'sign_in_label' => 'Se connecter',
                'username_parameter' => 'email',
            ]
        );
    }
}
