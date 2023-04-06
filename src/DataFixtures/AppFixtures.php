<?php

namespace App\DataFixtures;

use App\Entity\Acquisition;
use App\Entity\Address;
use App\Entity\Annonce;
use App\Entity\Bank;
use App\Entity\Commentary;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $user = new User();
        $acquisition = new Acquisition();
        $address = new Address();
        $annonce = new Annonce();
        $bank = new Bank();
        $commentary = new Commentary();

        // Set User
        $user->setEmail('borges.mathieu@gmail.com');
        $user->setPassword('blabla38');
        $user->setBank($bank);
        $user->setRoles(['ROLE_USER']);
        $user->addAcquisition($acquisition);
        $user->addAddress($address);
        $user->addAnnonce($annonce);
        $user->addCommentary($commentary);
        $user->setPseudo('Math');

        // Set Bank
        $bank->addUser($user);
        $bank->setAmount(5000000);

        // Set Address
        $address->setCity('Moirans');
        $address->setStreet('12 avenue babar');
        $address->setUser($user);
        $address->setZip('38330');

        // Set Commentary
        $commentary->setUser($user);
        $commentary->setAnnonce($annonce);
        $commentary->setText('Oé G jamé vu D poms aussi bèles Trollollollollollo');

        // Set Annonce
        $annonce->setName('vente de pommes');
        $annonce->setDescription('Nos pommes sont tellement bonnes, vous allez en tomber dans les pommes ! Alors venez vite en acheter avant de perdre connaissance.');
        $annonce->addCommentary($commentary);
        $annonce->setPrice(40);
        $annonce->setAcquisition($acquisition);
        $annonce->addCommentary($commentary);
        $annonce->setUser($user);
        $annonce->setIsVisible(true);

        $acquisition->setAddress($address);
        $acquisition->setAnnonce($annonce);
        $acquisition->setUser($user);

        $manager->persist($user);
        $manager->persist($bank);
        $manager->persist($address);
        $manager->persist($annonce);
        $manager->persist($commentary);
        $manager->persist($acquisition);

        $manager->flush();
    }
}
