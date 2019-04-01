@extends('layouts.app', ['title' => 'Бронирование'])

@section('content')
    <form action="{{route('createApp')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if(Session::has('success'))
            <div class="alert alert-success  alert-block">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="alert alert-warning alert-block">
                <p>{{ Session::get('error') }}</p>
            </div>
        @endif

        <div class="form-group">
            <label for="title">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Имя" required>
        </div>
        @if($errors->has('name'))
            <font color="red"><p>  {{$errors->first('name')}}</p></font>
        @endif

        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" class="input-medium bfh-phone" required>
        </div>
        @if($errors->has('phone'))
            <font color="red"><p>  {{$errors->first('phone')}}</p></font>
        @endif
        <div class="dates">
            <label>Дата заезда</label>
            <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control" name="arrival"
                   id="arrival" placeholder="YYYY-MM-DD" autocomplete="off">
        </div>
        @if($errors->has('phone'))
            <font color="red"><p>  {{$errors->first('phone')}}</p></font>
        @endif
        <div class="dates">
            <label>Дата выезда</label>
            <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control" name="departure"
                   id="departure" placeholder="YYYY-MM-DD" autocomplete="off">
        </div>
        <button type="submit" class="btn btn-primary">Создать заявку</button>
    </form>
@endsection