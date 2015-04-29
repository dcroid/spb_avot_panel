<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 10:25
 */
class ApiController extends BaseController
{
    /**
     * Берем номер для регистрации
     * @return \Illuminate\Http\JsonResponse
     */
    public function getnumber()
    {

        try {

            $poster_id = Request::all()['poster_id'];
            if ($poster_id) {
                $statusCode = 200;
                $result['code'] = '1';

                $result['result'] = AvitoAcc::whereNull('code', 'and')
                    ->where('user_id', '=', $poster_id, 'and')
                    ->where('step_reg', '=', 0)
                    ->get(['id', 'tel'])
                    ->first();

                if (count($result) == 0 || $result['result'] == null) {
                    $statusCode = 400;
                    $result['code'] = '0';
                    $result['notes'] = 'not numbers';
                } else {
                    AvitoAcc::updateStepReg($result['result']['id'], 1);
                }
            } else {
                $statusCode = 404;
                $result['error']['code'] = '0';
                $result['error']['notes'] = 'no poster ID';
            }
        } catch (Exception $e) {
            $statusCode = 404;
            $result['error']['code'] = '0';
            $result['error']['notes'] = 'error query';
        } finally {

            return Response::json($result, $statusCode);
        }
    }

    /**
     * Получаем смс код
     * @param $tel
     * @return \Illuminate\Http\JsonResponse
     */
    public function getcode($tel)
    {
        try {
            $statusCode = 200;
            $result['result'] = AvitoAcc::where('tel', '=', $tel, 'and')
                ->whereNotNull('code')
                ->get(['id', 'code'])
                ->all();

            if ($result['result'] == null) {
                unset($result['result']);
                $statusCode = 200;
                $result['error']['code'] = '1';
                $result['error']['notes'] = 'not code';
            } else {
                AvitoAcc::updateStepReg($result['result']['id'], 2);
            }

        } catch (Exception $e) {
            $statusCode = 200;
            $result['error']['code'] = '0';
            $result['error']['notes'] = 'error query';
        } finally {
            return Response::json($result, $statusCode);
        }
    }


    public function accinfo()
    {
        $data = Request::all();

        if (isset($data['tel']) && isset($data['email']) && isset($data['password']) && isset($data['name'])) {


            try {
                $id = AvitoAcc::where('tel', '=', $data['tel'])->get(['id'])->first();
                AvitoAcc::updateAccBeforeReg($id['id'], $data['email'], $data['password'], $data['name']);
            } catch (Exception $e) {

            }

        }
    }

    public static function text($tmp_object)
    {
        return randomtext::inic(Text::where('tmp_object','=',$tmp_object)->orderByRaw('RAND()')->limit(1)->get(['text'])[0]['text']);
    }

    public static function address($tmp_object)
    {
        $allPostingAddress  = [];
        foreach(AdvertAvito::where('type_object','=',$tmp_object)->whereNull('deleted')->get(['address_id'])->toArray() as $k => $address_id){
            if(!empty($address_id['address_id']))
                $allPostingAddress[] = $address_id['address_id'];
        }
        
        if(count($allPostingAddress)>0){

            $addres =  Address::where('object_type', '=', $tmp_object, 'and')->whereNotIn('id', array_unique($allPostingAddress))->get(['id','metro_id', 'address'])->toArray();

            //print_r($addres);

            return $addres[array_rand($addres, 1)];
        }

        return Address::where('object_type', '=', $tmp_object, 'and')->orderByRaw('RAND()')->limit(1)->get(['id','metro_id', 'address'])[0];


    }


    /**
     * Получаем все данные для постинга объявления
     * @param $tel
     */
    public function param($tel)
    {
        $statusCode = 200;
        try {
            $user = AvitoAcc::where('tel', '=', $tel)->get()->first();
            if ($user) {
                $user = $user->toArray();
                $price = Price::findOrFail($user['tmp_typeobj']);

                /** Площадь */
                if ($user['tmp_typeobj'] == 1 || $user['tmp_typeobj'] == 4) {
                    $_s = rand(35, 39);
                    $rooms = 1;
                } else if ($user['tmp_typeobj'] == 2 || $user['tmp_typeobj'] == 5) {
                    $_s = rand(39, 49);
                    $rooms = 2;
                } else if ($user['tmp_typeobj'] == 3 || $user['tmp_typeobj'] == 6) {
                    $_s = rand(60, 80);
                    $rooms = 3;
                } else {
                    $_s = rand(16, 20);
                    $rooms = 0;
                }


                $allEtaj = rand(9, 11);
                $etaj = rand(2, $allEtaj);

                $address = self::address($user['tmp_typeobj']);

                $result = [
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'name' => $user['name'],
                    'type_object' => $user['tmp_typeobj'],
                    'storey' => $allEtaj,
                    'floor' => $etaj,
                    'rooms' => $rooms,
                    's' => $_s,
                    'price' => $price['price'],
                    'text' => self::text($user['tmp_typeobj']),
                    'metro_id' => $address['metro_id'],
                    'address' => $address['address']
                ];
            } else {
                $result = ['error' => 2];
            }
        } catch (Exception $e) {
            $result = ['error' => 1];
        } finally {
            return Response::json($result, $statusCode);
        }
    }


    public function addlog()
    {
        $data = Request::all();

        if (isset($data['id']) && isset($data['log'])) {
            PosterLogger::create(
                [
                    'poster_id' => $data['id'],
                    'message' => $data['log']
                ]
            );
        }
    }


    public function advert(){
        try {

            $data = Request::all();
            $user = AvitoAcc::where('tel', '=', $data['tel'])->get(['id'])->first()->toArray();;

            AdvertAvito::create(
                [
                    'tel_id' => $user['id'],
                    'advert_id' => $data['advert_id'],
                    'type_object' => $data['type_object']
                ]
            );
        } catch (Exception $e) {
            $result = ['error' => 1];
        }
    }


    public static function paramToFace($data){

        $price = Price::findOrFail($data['type_object']);



        /** Площадь */
        if ($data['type_object'] == 1 || $data['type_object'] == 4) {
            $_s = rand(35, 39);
            $rooms = 1;
        } else if ($data['type_object'] == 2 || $data['type_object'] == 5) {
            $_s = rand(39, 49);
            $rooms = 2;
        } else if ($data['type_object'] == 3 || $data['type_object'] == 6) {
            $_s = rand(60, 80);
            $rooms = 3;
        } else {
            $_s = rand(16, 20);
            $rooms = 0;
        }


        $allEtaj = rand(9, 11);
        $etaj = rand(2, $allEtaj);



        $address = ApiController::address($data['type_object']);



        $result = [
            'id_address' => $address['id'],
            'type_object' => $data['type_object'],
            'storey' => $allEtaj,
            'floor' => $etaj,
            'rooms' => $rooms,
            's' => $_s,
            'price' => $price['price'],
            'text' => ApiController::text($data['type_object']),
            'metro_id' => $address['metro_id'],
            'address' => $address['address']
        ];

        return $result;
    }

    public function getID(){

        if(@AdvertSettings::where('param','=', 'check', 'and')->where('value','=', 1)->get(['value'])[0]['value'] != 1 )
            return '';

        $data = AdvertAvito::where('status', '>', 0, 'and')->whereNull('deleted')->get(['advert_id']);
        return Response::json(['result' => $data]);
    }

    public function stat(){

        $data = Input::all();


        $id =  AdvertAvito::where('advert_id','=', $data['id'])->get(['id'])->first();



        $advert = AdvertAvito::findOrFail($id['id']);

        if($advert && isset($data['show_today']) && isset($data['show_all'])) {

            $advert->show_today = $data['show_today'];

            $advert->show_all   = $data['show_all'];

            $advert->status = 1;

        } else{
            $advert->status = 0;
        }
        $advert->save();

        return Response::json(['result'=>'ok']);

    }
}