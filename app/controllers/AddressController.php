<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 16.01.15
 * Time: 6:17
 */
class AddressController extends BaseController
{


    static $metro = array(
        154 => 'Автово',
        2132 => 'Адмиралтейская',
        153 => 'Академическая',
        155 => 'Балтийская',
        2137 => 'Бухарестская',
        209 => 'Василеостровская',
        210 => 'Владимирская',
        1017 => 'Волковская',
        211 => 'Выборгская',
        164 => 'Горьковская',
        165 => 'Гостиный двор',
        166 => 'Гражданский проспект',
        159 => 'Девяткино',
        160 => 'Достоевская',
        162 => 'Елизаровская',
        212 => 'Звездная',
        1016 => 'Звенигородская',
        167 => 'Кировский завод',
        168 => 'Комендантский проспект',
        169 => 'Крестовский остров',
        170 => 'Купчино',
        171 => 'Ладожская',
        172 => 'Ленинский проспект',
        173 => 'Лесная',
        174 => 'Лиговский проспект',
        175 => 'Ломоносовская',
        176 => 'Маяковская',
        2138 => 'Международная',
        177 => 'Московская',
        178 => 'Московские ворота',
        179 => 'Нарвская',
        180 => 'Невский проспект',
        181 => 'Новочеркасская',
        2122 => 'Обводный канал',
        182 => 'Обухово',
        183 => 'Озерки',
        184 => 'Парк Победы',
        213 => 'Парнас',
        185 => 'Петроградская',
        186 => 'Пионерская',
        187 => 'Площадь А. Невского I',
        188 => 'Площадь А. Невского II',
        191 => 'Площадь Восстания',
        189 => 'Площадь Ленина',
        190 => 'Площадь Мужества',
        192 => 'Политехническая',
        194 => 'Приморская',
        195 => 'Пролетарская',
        196 => 'Проспект Большевиков',
        198 => 'Проспект Ветеранов',
        197 => 'Проспект Просвещения',
        199 => 'Пушкинская',
        200 => 'Рыбацкое',
        201 => 'Садовая',
        202 => 'Сенная площадь',
        1015 => 'Спасская',
        203 => 'Спортивная',
        204 => 'Старая деревня',
        205 => 'Технологический ин-т I',
        206 => 'Технологический ин-т II',
        207 => 'Удельная',
        208 => 'Улица Дыбенко',
        163 => 'Фрунзенская',
        156 => 'Черная речка',
        157 => 'Чернышевская',
        158 => 'Чкаловская',
        161 => 'Электросила'

    );

    public function index()
    {
        $id = Input::all();


        if(isset($id['object_type']))
            $data = Address::where('object_type', '=', $id['object_type'])->orderBy('metro_id', 'asc')->get();
        else
            $data = Address::orderBy('metro_id', 'asc')->get()->all();

        return View::make('Address.list')->with(['addresss' => $data, 'metro' => self::$metro]);
    }


    public function add()
    {
        return View::make('Address.create')->with(['metro' => self::$metro]);
    }


    public function create()
    {
        $data = Input::all();

        $validator = Validator::make(
            $data,
            [
                'address' => 'required|min:5|unique'
            ]
        );

        if ($validator->failed()) {
            echo $validator->messages();
            return 'Error';
        }

        try {
            Address::create(
                [
                    'metro_id' => $data['metro_id'],
                    'address' => $data['address'],
                    'object_type' => $data['object_type']
                ]
            );
            return Redirect::to('address')->with('status', 'Новый адрес добавлен');
        } catch (Exception $e) {
            return Redirect::to('address')->with('status', 'Адрес Не добавлен');
        }
    }

    public function address($id){
        $id = (int)$id;

        try {
            $data = Address::findOrFail($id);
            return View::make('Address.edit')->with(['address' => $data,'metro' => self::$metro]);
        } catch (Exception $e) {
            return 'Error! No Addres';
        }
    }


    public function edit(){
        $data = Input::all();

        $validator = Validator::make(
            $data,
            [
                'address' => 'required|min:5|unique'
            ]
        );

        if ($validator->failed()) {
            echo $validator->messages();
            return 'Error';
        }

        try {
            Address::updateAddress($data['id'], $data['metro_id'], $data['address'], $data['object_type']);
            return Redirect::to('address')->with('status', 'Адрес Обновлен');
        } catch (Exception $e) {
            return Redirect::to('address')->with('status', 'Адрес не Обновлен');
        }
    }

    public static function del($id){
        $id = (int)$id;
        $address = Address::findOrFail($id);
        $address->delete();
        return Redirect::to('address')->with('status', 'Адрес удален Успешно!');
    }
}