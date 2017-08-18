<?php

namespace Tests\Unit\AppBundle\Service;

use AppBundle\Service\ResponseArrayBuilder as SUT;
use AppBundle\Service\ResponseArrayBuilder;
use PHPUnit\Framework\TestCase;

class ResponseArrayBuilderTest extends TestCase
{
    /**
     * @var ResponseArrayBuilder
     */
    public $responseArrayBuilder;

    /**
     * @test
     */
    public function buildReturnsCorrectArray()
    {
        $this->responseArrayBuilder = new ResponseArrayBuilder();

        $actual = $this->responseArrayBuilder->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_created']);

        $this->assertEquals(
            [
                'status' => 201,
                'message' => 'The contact request resource has been created.'
            ],
            $actual
        );

        $actual = $this->responseArrayBuilder->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_accepted']);

        $this->assertEquals(
            [
                'status' => 201,
                'message' => 'The contact request resource has been accepted.'
            ],
            $actual
        );

        $actual = $this->responseArrayBuilder->build(ResponseArrayBuilder::RESPONSES_TYPES['contact_request_not_found']);

        $this->assertEquals(
            [
                'status' => 404,
                'message' => 'The contact request does not exist'
            ],
            $actual
        );
    }
}
