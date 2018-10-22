<?php

namespace App\Structural\DataMapper;

use App\Entity\ContactRequest;
use App\Repository\ContactRequestRepository;

class ContactRequestMapper
{
    /** @var ContactRequestRepository $contactRequestRepository */
    private $contactRequestRepository;

    /**
     * ContactRequestMapper constructor.
     * @param ContactRequestRepository $contactRequestRepository
     */
    public function __construct(ContactRequestRepository $contactRequestRepository)
    {
        $this->contactRequestRepository = $contactRequestRepository;
    }

    /**
     * @param int $contactRequestId
     * @return bool
     */
    public function acceptInvitation(int $contactRequestId) : bool
    {
        $contactRequest = $this->contactRequestRepository->find($contactRequestId);

        if (!$contactRequest) {
            return false;
        }

        $contactRequest->setStatus(ContactRequest::STATUS_ACCEPTED);

        $this->contactRequestRepository->save($contactRequest);

        return true;
    }
}
