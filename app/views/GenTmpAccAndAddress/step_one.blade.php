@extends('template.body')
@if(Auth::check())
@section('content')

    @include('template.menu')
    @if(isset($type_objects))

        @if(Session::get('status'))
            <div class="alert alert-error">{{Session::get('status')}}</div>
        @endif

        {{ Form::open(['method'=>'post', 'url'=>'/false_reg/step2']) }}
        @foreach($type_objects as $type_object)

            @if($type_object['type_object'] == $_cheked)
                {{Form::radio('type_object', $type_object['type_object'], 1)}}
            @else
                {{Form::radio('type_object', $type_object['type_object'])}}
            @endif

            @if($type_object['type_object'] == 7)
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
        {{ Form::submit('Далее', ['class'=>'btn btn-success']) }}
        {{ Form::close() }}
    @endif

@stop

@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif