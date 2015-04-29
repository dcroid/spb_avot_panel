@extends('template.body')





@section('content')

    @if(Session::get('status'))
        <div class="alert alert-info">{{Session::get('status')}}</div>
    @endif
    @include('template.menu')


    <ul class="nav nav-pills" style="text-align:center;font-size: 12px">
        <li><a href="/address?object_type=1">Однокомнатная (Обычная) [{{ Address::where('object_type','=',1)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=2">Двухкомнтная(Обычная) [{{ Address::where('object_type','=',2)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=3">Трехкомнатная(Обычная) [{{ Address::where('object_type','=',3)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=4">Однокомнатная(Элитная) [{{ Address::where('object_type','=',4)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=5">Двухкомнтная(Элитная) [{{ Address::where('object_type','=',5)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=6">Трехкомнатная(Элитная) [{{ Address::where('object_type','=',6)->count(['id']) }}]</a></li>
        <li><a href="/address?object_type=7">Комната [{{ Address::where('object_type','=',7)->count(['id']) }}]</a></li>

    </ul>


    {{ Form::open(['method'=>'post', 'url'=>'/address/add']) }}

    {{ Form::label('metro_id', 'Метро') }}
    {{ Form::select('metro_id', $metro) }}

    {{ Form::label('object_type', 'Тип Объекта') }}
    {{ Form::select('object_type',[1=>'Однокомнатная (Обычная)', 2=>'Двухкомнтная(Обычная)',3=>'Трехкомнатная(Обычная)',4=>'Однокомнатная(Элитная)', 5=>'Двухкомнтная(Элитная)',6=>'Трехкомнатная(Элитная)',7=>'Комната']) }}

    {{ Form::label('address', 'Адрес') }}
    {{ Form::text('address', null, ['palceholder'=> 'Адрес объекта']) }}

    <br/>
    {{ Form::submit('Создать') }}
    {{ Form::close() }}


    <table class="table table-striped table-bordered table-hover">
        <tbody>
        <tr>
            <th>#</th>
            <th>Метро</th>
            <th>Адресс</th>
            <th>Редактировать</th>
            <th>Удалить</th>

        </tr>
        <tbody>
        @foreach($addresss as $address)
            <tr>
                <th>{{ $address['id'] }}</th>
                <th>{{ $metro[$address['metro_id']] }}</th>
                <th>{{ $address['address'] }}</th>
                <th><a class="btn btn-info" href="/address/id/{{$address['id']}}">Редактировать</a></th>
                <th><a class="btn btn-danger" href="/address/del/{{$address['id']}}">Удалить</a></th>

            </tr>
        @endforeach

    </table>
    {{ HTML::link('/address/add', 'Добавить Адресс', ['class'=>'btn btn-success']) }}



@stop
