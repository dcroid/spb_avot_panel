@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        <div class="alert alert-info">{{Session::get('status')}}</div>
    @endif
    @include('template.menu')
    <table class="table table-striped table-bordered table-hover">
        <tbody>
        <tr>
            <th>#</th>
            <th>E-mail</th>
            <th>Пароль</th>
            <th>Дата Добавления</th>
            <th>Редактировать </th>
            <th>Удалить </th>

        </tr>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th>{{ $user['id'] }}</th>
                <th>{{ $user['email'] }}</th>
                <th>{{ $user['password'] }}</th>
                <th>{{ $user['created_at'] }}</th>
                <th><a class="btn btn-info" href="/user/id/{{$user['id']}}">Редактировать</a> </th>
                <th><a class="btn btn-danger" href="/user/del/{{$user['id']}}">Удалить</a> </th>

            </tr>
        @endforeach

    </table>
    {{ HTML::link('/user/add', 'Создать пользователя',['class'=>'btn btn-success']) }}



@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif