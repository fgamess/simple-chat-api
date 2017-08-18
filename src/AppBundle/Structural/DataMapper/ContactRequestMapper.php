<?php

namespace AppBundle\Structural\DataMapper;

use AppBundle\Entity\ContactRequest;

class ContactRequestMapper extends CommonMapper
{
    /**
     * [acceptInvitation description]
     * @param  ContactRequest $contactRequest [description]
     * @return [type]                         [description]
     */
    public function acceptInvitation(ContactRequest $contactRequest = null) : bool
    {
        if (!$contactRequest) {
            return false;
        }
        $contactRequest->setStatus(ContactRequest::STATUS_ACCEPTED);

        $this->save($contactRequest, true);

        return true;
    }
}
