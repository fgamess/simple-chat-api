<?php

namespace AppBundle\Structural\DataMapper;

use Doctrine\ORM\EntityManagerInterface;

abstract class CommonMapper
{
    /**
     * [private description]
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save($entity = null, bool $flush = false)
    {
        $this->em->persist($entity);

        if ($flush) {
            $this->em->flush($entity);
        }
    }
}
