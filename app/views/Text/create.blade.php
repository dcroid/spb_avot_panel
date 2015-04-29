@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    {{ Form::open(['method'=>'post']) }}

    {{ Form::label('text', 'Текст') }}
    {{ Form::textarea('text', null, ['palceholder'=> 'Текст', 'rows'=>10, 'cols'=>300, 'style'=>'width: 100%;' ]) }}

    <br />

    {{ Form::select('tmp_object', [
        '1' => '1-комнатная',
        '2' => '2-комнатная',
        '3' => '3-комнатная',
        '4' => 'Элитная 1-комнатная',
        '5' => 'Элитная 2-комнатная',
        '6' => 'Элитная 3-комнатная',
        '7' => 'Комната',
    ]) }}
    <br />
    {{ Form::submit('Создать') }}
    {{ Form::close() }}
    <span class="icon-arrow-left"></span>
    {{ HTML::link('/text', 'Назад', []) }}
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif