<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactRequest;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * [sendInvitationAction description]
     * @param  ContactRequest $contactRequest [description]
     * @Rest\Post("/send-invitation")
     * @Rest\View
     * @ParamConverter("contactRequest", converter="fos_rest.request_body")
     */
    public function sendInvitationAction(ContactRequest $contactRequest)
    {
        dump($contactRequest);
        $this->get('app.structural.data_mapper.contact_request')->save($contactRequest, true);
        die;
    }

    /**
     * [sendInvitationAction description]
     * @param  ContactRequest $contactRequest [description]
     * @Rest\Post("/accept-invitation")
     * @Rest\View
     */
    public function acceptInvitationAction(ContactRequest $contactRequest)
    {
        $contactRequestMapper = $this->get('app.structural.data_mapper.contact_request');
        dump($contactRequest);
        die;
    }
}
