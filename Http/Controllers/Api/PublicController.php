<?php

namespace Modules\Newsletter\Http\Controllers\Api;

use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Newsletter\Http\Requests\CreateSubscriberRequest;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function subscribe(CreateSubscriberRequest $request)
    {
        try {
            $apiUrl = setting('newsletter::api-url');
            $apiKey = setting('newsletter::api-key');
            $listId = setting('newsletter::list-id');

            $client = new \GuzzleHttp\Client();
            $res = $client->post("$apiUrl/$listId/subscribers/store", [
                'form_params' => [
                    'api_token' => $apiKey,
                    'EMAIL'     => $request->get('email'),
                    'ADINIZ'    => $request->get('name')
                ]
            ]);
            return response()->json([
               'status'      => true,
               'status_code' => $res->getStatusCode()
            ]);
        } catch (ClientException $exception) {
            if($exception->hasResponse()) {
                $response = $exception->getResponse();
                return response()->json([
                   'status' => false,
                   'data'   => $response->getBody()->getContents()
                ]);
            }
        }

    }
}
