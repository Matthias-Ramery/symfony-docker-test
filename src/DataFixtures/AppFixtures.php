<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $countryToPush = array("FR", "BE", "DE", "ES", "NE");

        for ($p = 0; $p < count($countryToPush); $p++) {
            $country = new Country();
            $country->setCode($countryToPush[$p]);
            $manager->persist($country);
        }

        $manager->flush();
    }
}
