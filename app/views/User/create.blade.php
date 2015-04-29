@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    {{ Form::open(['method'=>'post']) }}

    {{ Form::label('email', 'E-mail') }}
    {{ Form::email('email', null, ['palceholder'=> 'Email']) }}

    {{ Form::label('password', 'Пароль') }}
    {{ Form::password('password', null, ['palceholder'=> 'Пароль']) }}
    <br />
    {{ Form::submit('Создать') }}
    {{ Form::close() }}
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif