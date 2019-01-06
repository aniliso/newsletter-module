<?php

namespace Modules\Newsletter\Http\Controllers\Api;

use GuzzleHttp\Exception\ClientException;
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

            $params = config('asgard.newsletter.config.form_params');
            $formParams = [];
            $formParams['api_token'] = $apiKey;
            foreach ($params as $key => $param) {
                $formParams[$key] = $request->get($param);
            }

            $client = new \GuzzleHttp\Client();
            $res = $client->post("$apiUrl/$listId/subscribers/store", [
                'form_params' => $formParams
            ]);
            return response()->json([
               'status'      => true,
               'message'     => trans('newsletter::subscribers.messages.subscriber success'),
               'status_code' => $res->getStatusCode()
            ]);
        } catch (ClientException $exception) {
            if($exception->hasResponse()) {
                $response = $exception->getResponse()->getBody()->getContents();
                return response()->json([
                    'status' => false,
                    'message' => trans('newsletter::subscribers.messages.subscriber already registered'),
                    'data'   => $response
                ], Response::HTTP_BAD_REQUEST);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => trans('newsletter::subscribers.messages.subscriber already registered'),
                    'data'   => $exception->getMessage()
                ], Response::HTTP_BAD_REQUEST);
            }
        }

    }
}
