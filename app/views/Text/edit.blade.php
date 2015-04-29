@extends('template.body')
@if(Auth::check())
@section('content')
    @include('template.menu')
    @if(isset($text))
    {{ Form::open(['method'=>'post']) }}

    {{ Form::label('text', 'Текст') }}
    {{ Form::textarea('text', $text['text'], ['palceholder'=> 'Текст', 'rows'=>10, 'cols'=>300, 'style'=>'width: 100%;' ]) }}
    {{ Form::hidden('id', $text['id'],[] ) }}
    {{ Form::select('tmp_object', [
        '1' => '1-комнатная',
        '2' => '2-комнатная',
        '3' => '3-комнатная',
        '4' => 'Элитная 1-комнатная',
        '5' => 'Элитная 2-комнатная',
        '6' => 'Элитная 3-комнатная',
        '7' => 'Комната',
    ], $text['tmp_object']) }}
    <br />
    {{ Form::submit('Обновить') }}
    {{ Form::close() }}
    @else
    <h3>Текста не существует</h3>
    @endif
    <span class="icon-arrow-left"></span>
    {{ HTML::link('/text', 'Назад', []) }}
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif