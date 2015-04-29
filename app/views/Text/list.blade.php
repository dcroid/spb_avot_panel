@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        <div class="alert alert-info">{{Session::get('status')}}</div>
    @endif
    @include('template.menu')
    @if(isset($texts))
    <table class="table table-striped table-bordered table-hover">
        <tbody>
        <tr>
            <th>#</th>
            <th>Текст</th>

            <th>Вид Объекта </th>

            <th>Дата обновления </th>
            <th>Редактировать </th>
            <th>Удалить </th>

        </tr>
        <tbody>
        @foreach($texts as $text)
            <tr>
                <th>{{ $text['id'] }}</th>
                <th>{{ $text['text'] }}</th>
                <th>
                    @if($text['tmp_object'] == 1)
                        1-комнатная
                    @elseif($text['tmp_object'] == 2)
                        2-комнатная
                    @elseif($text['tmp_object'] == 3)
                        3-комнатная
                    @elseif($text['tmp_object'] == 4)
                        Элитная 1-комнатная
                    @elseif($text['tmp_object'] == 5)
                        Элитная 2-комнатная
                    @elseif($text['tmp_object'] == 6)
                        Элитная 3-комнатная
                    @elseif($text['tmp_object'] == 7)
                        Комната
                    @endif


                </th>
                <th>{{ $text['updated_at'] }}</th>
                <th><a class="btn btn-info" href="/text/id/{{$text['id']}}">Редактировать</a> </th>
                <th><a class="btn btn-danger" href="/text/del/{{$text['id']}}">Удалить</a> </th>

            </tr>
        @endforeach

    </table>
    @endif
    {{ HTML::link('/text/add', 'Добавить текст', ['class'=>'btn btn-success']) }}
@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif