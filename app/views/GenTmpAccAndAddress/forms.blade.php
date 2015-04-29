@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    @if(isset($data))

        {{ Form::open(['method'=>'post', 'url'=>'/false_reg/finish']) }}


        {{Form::label('tel','Телефон')}}
        {{Form::text('tel',$data['tel'])}}

        {{Form::label('name','Имя')}}
        {{Form::text('name',$data['name'])}}

        {{Form::label('email','Email')}}
        {{Form::text('email',$data['email'])}}

        {{Form::label('password','Пароль')}}
        {{Form::text('password',$data['password'])}}

        {{Form::label('s','Площадь')}}
        {{Form::text('s',$data['s'])}}


        {{Form::label('metro','Метро')}}
        {{Form::text('metro',AddressController::$metro[$data['metro_id']] )}}

        {{Form::label('address','Улица')}}
        {{Form::text('address',$data['address'])}}


        {{Form::label('text','Текст')}}
        {{Form::textarea('text',$data['text'])}}

        {{Form::label('price','Цена')}}
        {{Form::text('price',$data['price'])}}

        {{Form::label('advert_id','Введите URL объявления')}}
        {{Form::text('advert_id','')}}

        {{ Form::hidden('address_id' , $data['id_address']) }}

        {{ Form::hidden('type_object', $data['type_object']) }}
        <br/>
        {{ Form::submit('Обновить', ['class'=>'btn btn-info']) }}
        {{ Form::close() }}
    @endif
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif