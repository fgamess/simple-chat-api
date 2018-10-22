<?php

namespace App\Service;

class ResponseArrayBuilder
{
    const RESPONSES_TYPES = [
        'contact_request_created' => 'buildContactRequestCreated',
        'contact_request_accepted' => 'buildContactRequestAccepted',
        'contact_request_not_found' => 'buildContactRequestNotFound'
    ];

    public function build(string $responseType) : array
    {
        return $this->{$responseType}();
    }

    private function buildContactRequestCreated() : array
    {
        return [
            'status' => 201,
            'message' => 'The contact request resource has been created.'
        ];
    }

    private function buildContactRequestAccepted() : array
    {
        return [
            'status' => 201,
            'message' => 'The contact request resource has been accepted.'
        ];
    }

    private function buildContactRequestNotFound() : array
    {
        return [
            'status' => 404,
            'message' => 'The contact request does not exist'
        ];
    }

}