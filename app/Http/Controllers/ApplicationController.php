<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Application;

class ApplicationController extends Controller
{
    private $url = "https://ko.tour-shop.ru/siteLead";
    private $site_id = 100;

    //
    function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'phone' => 'required',
        ]);
        $client = new \GuzzleHttp\Client();
        $form_params = [
            'site_id' => $this->site_id,
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
        $lead_id = substr($body, strpos($body, "=") + 1);
        $body->seek(0);
        $body->read(1024);
        $application = new \App\Application();
        $application->name = $request->name;
        $application->arrival_date = $request->arrival;
        $application->departure_date = $request->departure;
        $application->phone = $request->phone;
        $application->lead_id = intval($lead_id);
        $application->save();
    }
}
