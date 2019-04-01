@extends('layouts.app', ['title' => 'Бронирование'])

@section('content')
    <div class="container bg-faded">
        <form class="form-horizontal" action="{{route('createApp')}}" method="post" enctype="multipart/form-data">
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

            <div class="form-group row">
                <label for="title" class="col-md-2 control-label">Имя:</label>
                <div class="col-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Имя" width="100"
                           required>
                </div>
            </div>


            @if($errors->has('name'))
                <font color="red"><p>  {{$errors->first('name')}}</p></font>
            @endif
            <br>
            <div class="form-group row">
                <label for="phone" class="col-md-2 control-label">Телефон:</label>
                <div class="col-3">
                    <input type="text" id="phone" name="phone" class="input-medium bfh-phone" width="100" required>
                    @if($errors->has('phone'))
                        <font color="red"><p>  {{$errors->first('phone')}}</p></font>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="dates">
                    <label for="arrival" class="col-md-3 control-label">Дата заезда</label>
                    <div class="col-10">
                        <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control"
                               name="arrival"
                               id="arrival" placeholder="YYYY-MM-DD" autocomplete="off" required>
                    </div>
                </div>
            </div>
            @if($errors->has('phone'))
                <font color="red"><p>  {{$errors->first('phone')}}</p></font>
            @endif

            <div class="form-group row">
                <div class="dates">
                    <label class="col-md-3 control-label">Дата выезда</label>
                    <div class="col-10">
                        <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control"
                               name="departure"
                               id="departure" placeholder="YYYY-MM-DD" autocomplete="off" required>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Создать заявку</button>
        </form>
    </div>
@endsection