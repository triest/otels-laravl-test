<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    private $url = "https://ko.tour-shop.ru/siteLead";

    //
    function create(Request $request)
    {
        dump($request);


        $validatedData = $request->validate([
            'name' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
        ]);
        $client = new \GuzzleHttp\Client();
        $array = [];
        $data = ['name' => 'Имя', 'value' => $request->name];
        array_push($array, $data);
        $data = ['name' => 'Дата заезда', 'value' => $request->arrival];
        array_push($array, $data);
        $data = ['name' => 'Дата выезда', 'value' => $request->departure];
        array_push($array, $data);
        $data = ['name' => 'Телефон', 'value' => $request->phone];
        array_push($array, $data);
        $body['site_id'] = 100;
        $body['type'] = 'order';
        $body['data'] = $array;

        $form_params = [
            'site_id' => 100,
            'type' => 'order',
            'data' => [
                ['name' => 'Имя', 'value' => $request->name],
                ['name' => 'Дата заезда', 'value' => $request->arrival],
                ['name' => 'Дата выезда', 'value' => $request->departure],
                ['name' => 'Телефон', 'value' => $request->phone],
            ],
        ];

        $response = $client->post($this->url, [
            'headers' => ['KoSiteKey' => 'test198'],
            'form_params' => $form_params,
        ]);
        $body = $response->getBody();
        echo $body;
// Cast to a string: { ... }
        $body->seek(0);
// Rewind the body
        $body->read(1024);

    }
}
