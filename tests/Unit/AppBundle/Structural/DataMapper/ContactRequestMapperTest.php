<?php

namespace Tests\Unit\AppBundle\Structural\DataMapper;

use AppBundle\Entity\ContactRequest;
use AppBundle\Structural\DataMapper\ContactRequestMapper as SUT;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class ContactRequestMapperTest extends TestCase
{
    /**
     * [public description]
     * @var ContactRequestMapper
     */
    public $contactRequestMapper;

    /**
     * [private description]
     * @var EntityManagerInterface
     */
    private $em;

    public function setUp()
    {
        $this->em = $this->createMock(EntityManagerInterface::class);
        $this->contactRequestMapper = new SUT($this->em);
    }

    /**
     * @test
     */
    public function saveFunctionPersistsWithoutFlushing()
    {
        $contactRequestToPersist = new ContactRequest();
        $this->em
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($contactRequestToPersist))
        ;
        $this->contactRequestMapper->save($contactRequestToPersist);
    }

    /**
     * @test
     */
    public function saveFunctionPersistsAndFlush()
    {
        $contactRequestToPersist = new ContactRequest();
        $this->em
            ->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($contactRequestToPersist))
        ;
        $this->em
            ->expects($this->once())
            ->method('flush')
            ->with($this->equalTo($contactRequestToPersist))
        ;
        $this->contactRequestMapper->save($contactRequestToPersist, true);
    }
}
