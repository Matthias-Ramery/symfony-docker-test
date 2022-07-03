<?php

namespace App\DataFixtures;

use App\Entity\Country;
use App\Entity\ListRappel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $countryToPush = array("FR", "BE", "DE", "ES", "NL");

        for ($p = 0; $p < count($countryToPush); $p++) {
            $country = new Country();
            $listRappel = new ListRappel();

            $country->setCode($countryToPush[$p]);
            
            $manager->persist($country);

            $listRappel->setFirstName("matthias" . $p)
            ->setLastName("ramery" . $p)
            ->setPhoneNumberNational("0781869278")
            ->setPhoneNumberInternational("+33781869278")
            ->setCountryCode($country);
            
            $manager->persist($listRappel);
        }

        $manager->flush();
    }
}
