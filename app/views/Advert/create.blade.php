@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    {{ Form::open(['method'=>'post']) }}

    {{ Form::label('metro_id', 'Метро') }}
    {{ Form::select('metro_id', $metro) }}

    {{ Form::label('address', 'Адрес') }}
    {{ Form::text('address', null, ['palceholder'=> 'Адрес объекта']) }}

    <br/>
    {{ Form::submit('Создать') }}
    {{ Form::close() }}
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif