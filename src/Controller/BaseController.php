<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class BaseController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param $data
     * @param int  $statusCode
     *
     * @return Response
     *
     * @throws \InvalidArgumentException
     */
    protected function createApiResponse($data, int $statusCode = 200): Response
    {
        $json = $this->serialize($data);

        return new Response(
            $json,
            $statusCode,
            array(
            'Content-Type' => 'application/json'
            )
        );
    }

    /**
     * @param $data
     * @param string $format
     *
     * @return string
     */
    protected function serialize($data, $format = 'json'): string
    {
        return $this->serializer->serialize($data, $format);
    }
}
