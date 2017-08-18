<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactRequest;
use AppBundle\Service\ResponseArrayBuilder;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

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
//        dump($contactRequest);
        $this->get('app.structural.data_mapper.contact_request')->save($contactRequest, true);
        $responseArray = $this->get(ResponseArrayBuilder::class)->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_created']);

        return new JsonResponse($this->get('serializer')->serialize($responseArray, 'json'));
    }

    /**
     * [sendInvitationAction description]
     * @param  ContactRequest $contactRequest [description]
     * @Rest\Post("/accept-invitation")
     * @Rest\View
     */
    public function acceptInvitationAction(Request $request)
    {
        $contactRequestId = $request->request->getInt('contactRequestId');
        $contactRequestMapper = $this->get('app.structural.data_mapper.contact_request');
        $success = $contactRequestMapper->acceptInvitation($contactRequestId);

        if ($success) {
            $responseArray = $this->get(ResponseArrayBuilder::class)->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_accepted']);
        } else {
            $responseArray = $this->get(ResponseArrayBuilder::class)->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_not_found']);
        }

        return new JsonResponse($this->get('serializer')->serialize($responseArray, 'json'));
    }
}
