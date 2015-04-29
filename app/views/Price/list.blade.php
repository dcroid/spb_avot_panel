@extends('template.body')
@if(Auth::check())
@section('content')


    @if(Session::get('status'))
        <div class="alert alert-info"> {{Session::get('status')}} </div>
    @endif

    @include('template.menu')
    @if(isset($prices))
        <table class="table table-striped table-bordered table-hover">
            <tbody>
            <tr>
                <th>Тип Объекта</th>
                <th>Цена</th>

            </tr>
            <tbody>
            {{ Form::open(['method'=>'post']) }}
            @foreach($prices as $price)
                <tr>
                    @if($price['type_object'] == 0)
                        <th>Комната</th>
                    @elseif($price['type_object'] == 1)
                        <th>Однокомнатная кв.</th>
                    @elseif($price['type_object'] == 2)
                        <th>Двухкомнатная кв.</th>
                    @elseif($price['type_object'] == 3)
                        <th>Трехкомнатная кв.</th>
                    @elseif($price['type_object'] == 4)
                        <th>Элитная Однокомнатная кв.</th>
                    @elseif($price['type_object'] == 5)
                        <th>Элитная Двухкомнатная кв.</th>
                    @elseif($price['type_object'] == 6)
                        <th>Элитная Трехкомнатная кв.</th>

                    @endif
                    <th>{{ Form::text('price[]', $price['price']) }}</th>
                    {{ Form::hidden('id[]', $price['id']) }}

                </tr>
            @endforeach
            <tr>
                <th>{{ Form::submit('Обновить', ['class'=> 'btn btn-info']) }}
                    {{ Form::close() }}</th>
            </tr>
        </table>
    @endif

@stop
@else

    {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}

@endif