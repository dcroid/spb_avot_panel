@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        {{Session::get('status')}}
    @endif
    @include('template.menu')


        <h3>Аккаунт в ближайшее время будет создан!</h3>
        <a href="/reg">Зарегистрировать новый аккаунт</a>


@stop

@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif
