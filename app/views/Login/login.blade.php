@extends('template.body')

@section('content')




    <h3>Авторизация</h3>

    @if(Session::get('status'))
        <div class="alert alert-error">{{Session::get('status')}}</div>
    @endif

    <span style="width:985px; margin:0 auto;">
    {{ Form::open(['url'=>'/login']) }}
    {{ Form::text('email', null, ['placeholder'=> 'E-mail']) }}
    {{ Form::password('password',  ['placeholder'=> 'Password']) }}
        <br />
    {{ Form::submit('Войти', ['class'=> 'btn btn-primary']) }}
    {{ Form::close() }}
    </span>
@stop
