@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    @if(isset($address) && count($address) > 0)
    {{ Form::open(['method'=>'post','url'=>'/address/id/'.$address['id']]) }}

    {{ Form::label('metro_id', 'Метро') }}
    {{ Form::select('metro_id', $metro, $address['metro_id']) }}

    {{ Form::label('address', 'Адрес') }}
    {{ Form::text('address', $address['address'], ['palceholder'=> 'Пароль']) }}
    <br />
    {{ Form::hidden('id', $address['id']) }}
    {{ Form::submit('Обновить') }}
    {{ Form::close() }}
    @else
        <h3>Адреса не существует</h3>
    @endif
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif