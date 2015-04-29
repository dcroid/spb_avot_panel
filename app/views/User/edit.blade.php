@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    @if(isset($user) && count($user) > 0)
    {{ Form::open(['method'=>'post','url'=>'/user/id/'.$user['id']]) }}

    {{ Form::label('email', 'E-mail') }}
    {{ Form::email('email', $user['email'], ['palceholder'=> 'Email']) }}

    {{ Form::label('password', 'Пароль') }}
    {{ Form::password('password', null, ['palceholder'=> 'Пароль']) }}
    <br />
    {{ Form::hidden('id', $user['id']) }}
    {{ Form::submit('Обновить') }}
    {{ Form::close() }}
    @else
        <h3>Пользователя не существует</h3>
    @endif
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif