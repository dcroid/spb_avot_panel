@extends('template.body')

@section('content')


    @if(Session::get('status'))
        <div class="alert alert-info">{{Session::get('status')}}</div>
    @endif
    @include('template.menu')
    <table class="table table-striped table-bordered table-hover">
        <tbody>
        <tr>
            <th>#</th>
            <th>Email</th>
            <th>Password</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>Дата обновления</th>

        </tr>
        <tbody>
        @foreach($accounts as $account)
            <tr>
                <th>{{ $account['id'] }}</th>
                <th>{{ $account['email'] }}</th>
                <th>{{ $account['password'] }}</th>
                <th>{{ $account['name'] }}</th>
                <th>{{ $account['tel'] }}</th>
                <th>{{ $account['updated_at'] }}</th>

            </tr>
        @endforeach

    </table>



@stop
