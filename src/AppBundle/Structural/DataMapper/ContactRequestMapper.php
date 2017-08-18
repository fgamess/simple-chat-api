<?php

namespace AppBundle\Structural\DataMapper;

use AppBundle\Entity\ContactRequest;

class ContactRequestMapper extends CommonMapper
{
    /**
     * [acceptInvitation description]
     * @param  int $contactRequestid [description]
     * @return [type]                         [description]
     */
    public function acceptInvitation(int $contactRequestId) : bool
    {
        $contactRequest = $this->em->getRepository('AppBundle:ContactRequest')->find($contactRequestId);

        if (!$contactRequest) {
            return false;
        }

        $contactRequest->setStatus(ContactRequest::STATUS_ACCEPTED);

        $this->save($contactRequest, true);

        return true;
    }
}
