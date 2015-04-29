@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    {{ Form::open(['method'=>'post']) }}

    {{ Form::label('metro_id', 'Метро') }}
    {{ Form::select('metro_id', $metro) }}

    {{ Form::label('object_type', 'Тип Объекта') }}
    {{ Form::select('object_type',[1=>'Однокомнатная (Обычная)', 2=>'Двухкомнтная(Обычная)',3=>'Трехкомнатная(Обычная)',4=>'Однокомнатная(Элитная)', 5=>'Двухкомнтная(Элитная)',6=>'Трехкомнатная(Элитная)',7=>'Комната']) }}

    {{ Form::label('address', 'Адрес') }}
    {{ Form::text('address', null, ['palceholder'=> 'Адрес объекта']) }}

    <br/>
    {{ Form::submit('Создать') }}
    {{ Form::close() }}

    @else

        {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

    @endif
@stop
