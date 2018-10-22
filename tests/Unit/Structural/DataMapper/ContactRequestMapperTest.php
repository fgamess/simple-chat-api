<?php

namespace Tests\Unit\Structural\DataMapper;

use App\Entity\ContactRequest;
use App\Repository\ContactRequestRepository;
use App\Structural\DataMapper\ContactRequestMapper;
use PHPUnit\Framework\TestCase;

class ContactRequestMapperTest extends TestCase
{
    /**  @var ContactRequestMapper $sut */
    public $sut;

    /**
     * @var ContactRequestRepository $contactRequestRepository
     */
    private $contactRequestRepository;

    public function setUp()
    {
        $this->contactRequestRepository = $this->createMock(ContactRequestRepository::class);
        $this->sut = new ContactRequestMapper($this->contactRequestRepository);
    }

    /**
     * @test
     */
    public function acceptInvitationReturnsFalse()
    {
        $id = rand(0, 100);
        $this->contactRequestRepository
            ->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn(null)
        ;
        $actual = $this->sut->acceptInvitation($id);

        $this->assertFalse($actual);
    }

    /**
     * @test
     */
    public function acceptInvitationReturnsTrue()
    {
        $id = rand(0, 100);
        $contactRequest = new ContactRequest();
        $this->contactRequestRepository
            ->expects($this->once())
            ->method('find')
            ->with($id)
            ->willReturn($contactRequest)
        ;
        $actual = $this->sut->acceptInvitation($id);

        $this->asserttrue($actual);
    }
}
