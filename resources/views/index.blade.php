@extends('layouts.app', ['title' => 'Бронирование'])

@section('content')
    <form action="{{route('createApp')}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <br>
        <div class="form-group">
            <label for="title">Имя:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Имя" required>
        </div>
        @if($errors->has('name'))
            <font color="red"><p>  {{$errors->first('name')}}</p></font>
        @endif

        <div class="dates" style="margin-top:100px;color:#2471a3;">
            <label>Дата зайзда</label>
            <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control" name="arrival" id="arrival" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off" >
        </div>
        <div class="dates" style="margin-top:100px;color:#2471a3;">
            <label>Дата выезда</label>
            <input type="text" style="width:200px;background-color:#aed6f1;" class="form-control" name="departure" id="departure" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off" >
        </div>


        <button type="submit" class="btn btn-primary">Создать заявку</button>
    </form>
@endsection