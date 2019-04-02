<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  \App\Application;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    private $url = "https://ko.tour-shop.ru/siteLead";
    private $site_id = 100;

    function list()
    {
        $applications = Application::select(
            ['id', 'name', 'arrival_date', 'departure_date', 'lead_id', 'phone', 'created_at'])
            ->orderBy('created_at')
            ->simplePaginate(30);

        return view('list')->with(['applications' => $applications]);
    }

    //
    function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'arrival' => 'required',
            'departure' => 'required',
            'phone' => 'required|regex:/((\d+)?$)/u',
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

        $arrival = $request->arrival;
        $departure = $request->departure;
        if ($departure < $arrival) {
            Session::flash('error', 'Дата заезда раньше даты выезда!');

            return redirect('http://otels.ru.xsph.ru/');
        }

        $mytime = date('Y-m-d');
        if ($arrival < $mytime) {
            Session::flash('error', 'Дата заезда уже прошла!');

            return redirect('http://otels.ru.xsph.ru/');
        }

        $response = $client->post($this->url, [
            'headers' => ['KoSiteKey' => 'test198'],
            'form_params' => $form_params,
        ]);
        $body = $response->getBody();

        //проверка, есть ли ошибка
        if (strpos($body, 'error') !== false) {
            Session::flash('error', 'Add error! '.$body);

            return redirect('http://otels.ru.xsph.ru/');
        }
        if ($body) {
            $lead_id = substr($body, strpos($body, "=") + 1);
        }
        $body->seek(0);
        $body->read(1024);
        $application = new \App\Application();
        $application->name = $request->name;
        $application->arrival_date = $request->arrival;
        $application->departure_date = $request->departure;
        $application->phone = $request->phone;
        $application->lead_id = intval($lead_id);
        $application->save();

        Session::flash('success', 'Заявка добавлена!');

        return redirect('http://otels.ru.xsph.ru/');
    }
}
