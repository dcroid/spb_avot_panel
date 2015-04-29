@extends('template.body')

@section('content')

    @if(Auth::check())

        @if(Session::get('status'))
            <div class="alert alert-info">{{Session::get('status')}}</div>
        @endif

        @include('template.menu')


        @if(@AdvertSettings::where('param','=', 'check', 'and')->where('value','=', 1)->get(['value'])[0]['value'] != 0)
            <span><a href="#" class="btn btn-info">Идет проверка ...</a></span>
        @else
            <span><a href="/advert/check" class="btn btn-success">Проверить</a></span>


        @endif


        <span><a href="/advert/deleted" class="btn btn-warning">Удаленные</a></span>
        <div class="pagination">
            {{$adverts->links()}}
        </div>

        <table class="table table-bordered">

            <tr>
                <th>#</th>
                <th>Вид</th>
                <th>Метро</th>
                <th>Адрес</th>
                <th>Кол-во Комн.</th>
                <th>Тип</th>
                <th>Тел.</th>
                <th>ID</th>
                <th>Today</th>
               
                <th>Total</th>
                 <th>Дата</th>
                <th>Email</th>
                <th>Passwd</th>
                <th>Qty</th>
                <th>Bal</th>
                <th>Red</th>
                <th>Status</th>
                <th>Start</th>
                <th>Del</th>

            </tr>

            @foreach($adverts as $advert)
                <!-- <tr bgcolor="@if($advert['status'] == 1)#7aba7b @elseif($advert['status'] == 0)pink @endif"> -->

                <tr   bgcolor="@if($advert['status'] == 1) #7aba7b @elseif($advert['status'] == 0)pink @endif">
                    <th>{{ $advert['id'] }}</th>
                    <th>
                        @if($advert['type_object'] == 1 || $advert['type_object'] == 2 || $advert['type_object'] == 3 || $advert['type_object'] == 4 || $advert['type_object'] == 5 || $advert['type_object'] == 6)
                            Квартира
                        @elseif($advert['type_object'] == 7)
                            Комнта
                        @endif
                    </th>
                    
                   	<th>{{ AddressController::$metro[$advert['metro_id']] }}</th>
                    <th>
                     {{ $advert['address'] }}
                    </th>
                    <th>
                        @if($advert['type_object'] == 1)
                            1
                        @elseif($advert['type_object'] == 2)
                            2
                        @elseif($advert['type_object'] == 3)
                            3
                        @elseif($advert['type_object'] == 4)
                            1
                        @elseif($advert['type_object'] == 5)
                            2
                        @elseif($advert['type_object'] == 6)
                            3
                        @elseif($advert['type_object'] == 7)
                            0
                        @endif
                    </th>
                    <th>
                        @if($advert['type_object'] == 1 || $advert['type_object'] == 2 || $advert['type_object'] == 3 || $advert['type_object'] == 7)
                            Обчная
                        @elseif($advert['type_object'] == 4 || $advert['type_object'] == 5 || $advert['type_object'] == 6)
                            Элитная
                        @endif</th>
                    <th>{{$advert['tel']}}</th>
                    <th><a href="https://www.avito.ru/moskva/kvartiry/kvartira_et._{{$advert['advert_id']}}"
                           target="_blank">{{$advert['advert_id']}}</a></th>
                    <th>{{$advert['show_today']}}</th>
                    <th>{{$advert['show_all']}}</th>
                    <th>{{$advert['created_at']}}</th>
                    <th>{{$advert['email']}}</th>
                    <th>{{$advert['password']}}</th>
                    <th></th>
                    <th><label>
                            @if($advert['bal'] == 1)
                                <input type="checkbox" name="bal" onclick="handleClick(this,{{ $advert['id']}});" value="0" checked/></label></th>
                            @else
                                <input type="checkbox" name="bal" onclick="handleClick(this,{{ $advert['id']}});" value="1" /></label></th>
                            @endif
                    <th><label>
                            @if($advert['red'] == 1)
                                <input type="checkbox" name="red" onclick="handleClick(this,{{ $advert['id']}});" value="0" checked/></label></th>
                            @else
                                <input type="checkbox" name="red" onclick="handleClick(this,{{ $advert['id']}});" value="1" /></label></th>
                            @endif
                    <th>@if($advert['status'] == 1)
                            <span class="icon-ok-sign"></span>
                        @else
                            <span class="icon-remove-circle"></span>
                        @endif</th>
                    <th></th>

                    <th><a class="btn btn-danger" href="/advert/del/{{$advert['id']}}">Удалить</a></th>

                </tr>
            @endforeach

        </table>
        <span><a href="/advert/deleted" class="btn btn-warning">Удаленные</a></span>
        <div class="pagination">
            {{$adverts->links()}}
        </div>

        <!-- Статистика -->
        @if(isset($stat))

        <table class="table table-bordered" style="width: 320px;">
            <caption>Статистика</caption>
            <tr>
                <th>1КВ </th><th>{{ $stat['one']['base'] }} ({{ $stat['one']['sum_show'][0] }} | {{ $stat['one']['sum_show'][1] }})</th> <th>{{ $stat['one']['elit'] }} ({{ $stat['one']['sum_show'][2] }} | {{ $stat['one']['sum_show'][3] }})</th>
            </tr>
            <tr>
                <th>2КВ</th> <th>{{ $stat['two']['base'] }} ({{ $stat['two']['sum_show'][0] }} | {{ $stat['two']['sum_show'][1] }})</th> <th>{{ $stat['two']['elit'] }} ({{ $stat['two']['sum_show'][2] }} | {{ $stat['two']['sum_show'][3] }})</th>
            </tr>
            <tr>
                <th>3КВ</th><th> {{ $stat['tree']['base'] }} ({{ $stat['tree']['sum_show'][0] }} | {{ $stat['tree']['sum_show'][1] }})</th> <th>{{ $stat['tree']['elit'] }} {{ $stat['tree']['elit'] }} ({{ $stat['tree']['sum_show'][2] }} | {{ $stat['tree']['sum_show'][3] }})</th>
            </tr><tr>
                <th>Ком:</th> <th>{{ $stat['com']['base'] }} ({{ $stat['com']['sum_show'][0] }} | {{ $stat['com']['sum_show'][1] }})</th><th></th>
            </tr><tr>

                <th>&#8721;</th><th> {{ $stat['one']['base'] +  $stat['two']['base'] + $stat['tree']['base'] + $stat['com']['base']}} </th><th>{{ $stat['one']['elit'] + $stat['two']['elit'] +  $stat['tree']['elit']}}</th>
            </tr>

            </table>
        @endif
        {{ HTML::script('/js/jsAjax/ajax.js') }}

    @else
        {{ Redirect::to('/')->with(['status'=>'Вы не авторизированы']) }}
    @endif

@stop
