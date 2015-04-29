@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        <div class="alert alert-info"> {{Session::get('status')}} </div>
    @endif
    @include('template.menu')
    @if(isset($logs))
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr>
                <th>#</th>
                <th>ID Постера</th>
                <th>Лог </th>
                <th>Дата обновления </th>

            </tr>
            <tbody>
            @foreach($logs as $log)
                <tr>
                    <th>{{ $log['id'] }}</th>
                    <th><a href="/logger/{{$log['poster_id']}}"> Poster_{{ $log['poster_id'] }}</a></th>
                    <th>{{ $log['message'] }}</th>
                    <th>{{ $log['created_at'] }}</th>
                </tr>
            @endforeach

        </table>
    @endif
    <div class="pagination">
    {{$logs->links()}}
    </div>
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif