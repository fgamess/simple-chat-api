<?php

namespace Tests\Unit\Structural\DataMapper;

use App\Entity\ContactRequest;
use App\Repository\ContactRequestRepository;
use App\Structural\DataMapper\ContactRequestMapper as SUT;
use App\Structural\DataMapper\ContactRequestMapper;
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

    /**
     * @test
     */
    public function acceptInvitationReturnsFalse()
    {
        $this->em
            ->expects($this->once())
            ->method('getRepository')
            ->with('AppBundle:ContactRequest')
            ->willReturn($this->createMock(ContactRequestRepository::class))
        ;
        $actual = $this->contactRequestMapper->acceptInvitation(1);

        $this->assertFalse($actual);
    }

    /**
     * @test
     */
    public function acceptInvitationReturnsTrue()
    {
        $contactRequestRepository =  $this->createMock(ContactRequestRepository::class);
        $contactRequestRepository->expects($this->once())
            ->method('find')
            ->willReturn(new ContactRequest())
        ;
        $this->em
            ->expects($this->once())
            ->method('getRepository')
            ->with('AppBundle:ContactRequest')
            ->willReturn($contactRequestRepository)
        ;
        $actual = $this->contactRequestMapper->acceptInvitation(1);

        $this->asserttrue($actual);
    }
}
