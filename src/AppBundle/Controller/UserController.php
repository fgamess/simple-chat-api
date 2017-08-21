<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ContactRequest;
use AppBundle\Service\ResponseArrayBuilder;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UserController extends FOSRestController
{
    /**
     * [sendInvitationAction description]
     * 
     * @param  ContactRequest $contactRequest [description]
     * @Rest\Post("/send-invitation")
     * @Rest\View
     * @ParamConverter("contactRequest", converter="fos_rest.request_body")
     */
    public function sendInvitationAction(ContactRequest $contactRequest)
    {
        $this->get('app.structural.data_mapper.contact_request')->save($contactRequest, true);
        $responseArray = $this->get(ResponseArrayBuilder::class)->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_created']);

        return $this->view(
            $responseArray,
            Response::HTTP_CREATED, 
            [
                'Location' => $this->generateUrl('get_contact_request', ['id' => $contactRequest->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
            ])
        ;
        /**
         * The code above is equivalent to creating a JsonResponse to which you pass the same parameters.
         */
        // return new JsonResponse(
        //     $responseArray,
        //     Response::HTTP_CREATED,
        //     [
        //         'Location' => $this->generateUrl('get_contact_request', ['id' => $contactRequest->getId(), UrlGeneratorInterface::ABSOLUTE_URL])
        //     ],
        //     false
        // );
    }

    /**
     * Get a ContactRequest resource
     * 
     * @param ContactRequest $contactRequest
     * @return void
     * @Rest\View
     * @Rest\Get(
     *     path = "/contact-requests/{id}",
     *     requirements = {"id"="\d+"}
     * )
     */
    public function getContactRequestAction(ContactRequest $contactRequest)
    {
        return $contactRequest;
        // return new JsonResponse($this->get('serializer')->serialize($contactRequest, 'json'), Response::HTTP_OK, [], true);
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

        return new JsonResponse($responseArray);
    }
}
