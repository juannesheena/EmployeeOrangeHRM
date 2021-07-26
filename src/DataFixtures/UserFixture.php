<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();        
        $user->setUsername('admin');

        $user->setPassword(
            $this->encoder->encodePassword($user,'1234')
        );
        // $employee = new Employee();
        // $employee->setId(1);

        // $user->setEmployee($employee);
        $manager->persist($user);

        $manager->flush();
    }
}
