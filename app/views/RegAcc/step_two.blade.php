@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        {{Session::get('status')}}
    @endif
    @include('template.menu')
    @if(isset($acc))

        {{ Form::open(['method'=>'post', 'url'=>'/reg/finish']) }}

        {{ Form::label('code', 'SMS Код') }}
        {{ Form::text('code',null) }}
        {{ Form::hidden('acc_id',$acc['id']) }}
        <br />
        {{ Form::submit('Закончить регистрацию', ['class'=>'btn btn-success']) }}
        {{ Form::close() }}
    @endif

@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif