<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {

    }
    public function load(ObjectManager $manager): void
    {
        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to Belgium');
        $microPost1->setText('Belgium is a great country to visit. We are praying for Belgium.');
        $microPost1->setCreated(new DateTime());
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to Germany');
        $microPost2->setText('Germany is another great country to visit. We are also praying for Germany.');
        $microPost2->setCreated(new DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to France');
        $microPost3->setText('France is a delightful country to visit. We are also praying for it.');
        $microPost3->setCreated(new DateTime());
        $manager->persist($microPost3);

        $user1 = new User();
        $user1->setEmail("mywebcreativities@gmail.com");
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword($user1, 'abcdefgh')
        );
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail("sweethoneyking@gmail.com");
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword($user2, 'abcdefgh')
        );
        $manager->persist($user2);

        $manager->flush();
    }
}
