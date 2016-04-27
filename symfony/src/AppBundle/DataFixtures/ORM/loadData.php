<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use AppBundle\Entity\Note;

class LoadData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $e1 = new Note();
        $e1->setName('Name 1');
        $e1->setNote('Desc 1');
        $e2 = new Note();
        $e2->setName('Name 2');
        $e2->setNote('Desc 2');
        $e3 = new Note();
        $e3->setName('Name 3');
        $e3->setNote('Desc 3');
        $e4 = new Note();
        $e4->setName('Name 4');
        $e4->setNote('Desc 4');
        $em->persist($e1);
        $em->persist($e2);
        $em->persist($e3);
        $em->persist($e4);
        $em->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}