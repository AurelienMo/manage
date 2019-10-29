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

namespace App\Domain\Security\Login;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

/**
 * Class LoginAuthenticator
 */
class LoginAuthenticator extends AbstractFormLoginAuthenticator
{
    /** @var UserRepository */
    protected $userRepo;

    /** @var UrlGeneratorInterface */
    protected $urlGenerator;

    /** @var UserPasswordEncoderInterface */
    protected $userPassword;

    /**
     * LoginAuthenticator constructor.
     *
     * @param UserRepository               $userRepo
     * @param UrlGeneratorInterface        $urlGenerator
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        UserRepository $userRepo,
        UrlGeneratorInterface $urlGenerator,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->userRepo = $userRepo;
        $this->urlGenerator = $urlGenerator;
        $this->userPassword = $passwordEncoder;
    }

    public function supports(Request $request)
    {
        return $request->isMethod('POST') && $request->attributes->get('_route') === 'login';
    }

    public function getCredentials(Request $request)
    {
        $credentials = [
            'email' => $request->request->get('email'),
            'password' => $request->request->get('_password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        if ($request->getSession() instanceof SessionInterface) {
            $request->getSession()->set(
                Security::LAST_USERNAME,
                $credentials['email']
            );
        }

        return $credentials;
    }

    public function getUser(
        $credentials,
        UserProviderInterface $userProvider
    ) {
        $user = $this->userRepo->loadUserByUsername($credentials['email']);
        if (is_null($user)) {
            throw new CustomUserMessageAuthenticationException('Identifiants invalides');
        }
        return $user;
    }

    public function checkCredentials(
        $credentials,
        UserInterface $user
    ) {
        $isValid = $this->userPassword->isPasswordValid($user, $credentials['password']);

        if (!$isValid) {
            throw new CustomUserMessageAuthenticationException('Identifiants invalides');
        }

        return true;
    }

    public function onAuthenticationSuccess(
        Request $request,
        TokenInterface $token,
        $providerKey
    ) {
        return new RedirectResponse($this->urlGenerator->generate('easyadmin'));
    }

    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate('login');
    }
}
