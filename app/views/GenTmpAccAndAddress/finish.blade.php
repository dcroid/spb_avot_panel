@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        {{Session::get('status')}}
    @endif
    @include('template.menu')



        <a href="/false_reg">Сгенерировать еще раз</a>


@stop

@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif
