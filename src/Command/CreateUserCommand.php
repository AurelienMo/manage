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

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class CreateUserCommand
 */
class CreateUserCommand extends Command
{
    const LIST_FIELDS = [
        'firstname' => null,
        'lastname' => null,
        'email' => null,
        'password' => null,
    ];

    /** @var UserRepository */
    protected $userRepo;

    /** @var EncoderFactoryInterface */
    protected $encoderFactory;

    public function __construct(
        UserRepository $userRepo,
        EncoderFactoryInterface $encoderFactory
    ) {
        $this->userRepo = $userRepo;
        $this->encoderFactory = $encoderFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Create User');
    }

    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $fields = self::LIST_FIELDS;
        foreach ($fields as $property => $value) {
            $fields[$property] = $this->getQuestionHelper()->ask(
                $input,
                $output,
                new Question(
                    sprintf("Please choose value for field '%s' : ", $property)
                )
            );
        }
        $encoder = $this->encoderFactory->getEncoder(User::class);

        $user = User::create(
            $fields['email'],
            $encoder->encodePassword($fields['password'], ''),
            $fields['firstname'],
            $fields['lastname']
        );

        $this->userRepo->persist($user);
        $this->userRepo->flush();
    }

    private function getQuestionHelper(): QuestionHelper
    {
        return $this->getHelper('question');
    }
}
