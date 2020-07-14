<?php

namespace App\Http\Controllers;

use App\Contracts\Producer;
use App\Requests\ProducerRequest;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ProducerController extends Controller
{

    /**
     * @param Producer $producer
     *
     * @return JsonResponse
     */
    public function produceEvent(ProducerRequest $request, Producer $producer): JsonResponse
    {
        $producer->produce(\GuzzleHttp\json_encode([
            'name' => $request->getEmail(),
            'email' => $request->getName()
        ]));

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);;
    }
}