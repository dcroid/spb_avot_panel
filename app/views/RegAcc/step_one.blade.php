@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        {{Session::get('status')}}
    @endif
    @include('template.menu')
    @if(isset($type_objects))

        {{ Form::open(['method'=>'post', 'url'=>'/reg/step_two']) }}
        @foreach($type_objects as $type_object)
            {{Form::radio('type_object', $type_object['type_object'])}}
            @if($type_object['type_object'] == 0)
                Комната
            @elseif($type_object['type_object'] == 1)
                Однокомнатная кв.
            @elseif($type_object['type_object'] == 2)
                Двухкомнатная кв.
            @elseif($type_object['type_object'] == 3)
                Трехкомнатная кв.
            @elseif($type_object['type_object'] == 4)
                Элитная Однокомнатная кв.
            @elseif($type_object['type_object'] == 5)
                Элитная Двухкомнатная кв.
            @elseif($type_object['type_object'] == 6)
                Элитная Трехкомнатная кв.

            @endif
            <br />
        @endforeach
        {{ Form::label('tel', 'Номер Телефоны') }}
        {{ Form::text('tel') }}
        {{ Form::hidden('id', Auth::user()->id) }}
        <br />
        {{ Form::submit('Отправить смс', ['class'=>'btn btn-success']) }}
        {{ Form::close() }}
    @endif

@stop

@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif