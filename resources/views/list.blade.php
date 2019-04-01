@extends('layouts.app', ['title' => 'Бронирование'])

@section('content')
    <div class="container bg-faded">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Дата прибытия</th>
                <th scope="col">Дата отбытия</th>
                <th scope="col">Создана</th>
                <th scope="col">№ заявки</th>
                <th scope="col">Телефон</th>
            </tr>
            </thead>
            <tbody>
            @foreach($applications as $application)
                <tr>
                    <td>{{$application->id}}</td>
                    <td>{{$application->name}}</td>
                    <td>{{$application->arrival_date}}</td>
                    <td>{{$application->departure_date}}</td>
                    <td>{{$application->created_at}}</td>
                    <td>{{$application->lead_id}}</td>
                    <td>{{$application->phone}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $applications->links() }}
    </div>
@endsection