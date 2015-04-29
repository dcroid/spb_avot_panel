<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 18.01.15
 * Time: 6:34
 */
class AccountController extends BaseController
{
    public function index()
    {
        $date = AvitoAcc::orderBy('id', 'desc')->get()->all();

        return View::make('Account.list')->with(['accounts' => $date]);
    }


    /**
     * Генерируем данные для аккаунта и заносим данные в базу
     */
    public function genacc()
    {
        $data = Input::all();



        $tel = $data['tel'];

        $data = ApiController::paramToFace($data);



        $data['email'] = options::genEmail();
        $data['name'] = options::name();
        $data['password'] = options::gen(10, 11);
        $data['tel'] = $tel;

        return View::make('GenTmpAccAndAddress.forms')->with(['data' => $data]);
    }


    function persetnRegObject($_config, $stat){


        if($_config == 0)
            return 100;

        try{
            $res = (100 / $_config) * $stat;

            if($res >= 100)
                $res = 100;

            $_persent = $res;
        }catch (Exception $e){
            $_persent = 0;
        }

        return $_persent;
    }

    public function pseudo()
    {
        $data = Price::get()->all();

        $_stat = AdvertController::statistic();


        $_config = [
            1=> Address::where('object_type','=',1)->count(['id']),
            2=> Address::where('object_type','=',2)->count(['id']),
            3=> Address::where('object_type','=',3)->count(['id']),
            4=> Address::where('object_type','=',4)->count(['id']),
            5=> Address::where('object_type','=',5)->count(['id']),
            6=> Address::where('object_type','=',6)->count(['id']),
            7=> Address::where('object_type','=',7)->count(['id'])
        ];

        //Высчитываем проценты

        $_persent[1] = $this->persetnRegObject($_config[1], $_stat['one']['base']);

        $_persent[2] = $this->persetnRegObject($_config[2], $_stat['two']['base']);

        $_persent[3] = $this->persetnRegObject($_config[3], $_stat['tree']['base']);

        $_persent[4] = $this->persetnRegObject($_config[4], $_stat['one']['elit']);

        $_persent[5] = $this->persetnRegObject($_config[5], $_stat['two']['elit']);

        $_persent[6] = $this->persetnRegObject($_config[6], $_stat['tree']['elit']);

        $_persent[7] = $this->persetnRegObject($_config[7], $_stat['com']['base']);



        $min =  min($_persent);

        foreach($_persent as $k=> $per){
            if($per == $min)
                break;
        }

		print_r($_persent);
        return View::make('GenTmpAccAndAddress.step_one')->with(['type_objects' => $data, '_cheked' => $k]);
    }

    public function finish(){


            $data = Input::all();

            if(preg_match('/_(\d{1,})$/', $data['advert_id'], $adv_id))
                $data['advert_id'] = $adv_id[1];


        try{

            $user =  AvitoAcc::create(
                [
                    'email'     => $data['email'],
                    'password'  => $data['password'],
                    'tel'       => $data['tel'],
                    'name'      => $data['name'],
                    'code'      => '0000',
                    'user_id'   => Auth::user()->id,
                    'tmp_typeobj' => $data['type_object']

                ]
            );
        } catch(Exception $e){
            $user = AvitoAcc::where('tel', '=', $data['tel'])->get(['id'])->first()->toArray();
        }

            try {
             AdvertAvito::create(
                [
                    'tel_id' => $user['id'],
                    'advert_id' => $data['advert_id'],
                    'type_object' => $data['type_object'],
                    'show_all' => 1,
                    'show_today' => 1,
                    'status' => 1,
                    'address_id' =>  $data['address_id'],
                ]
            );
        } catch (Exception $e) {
            return  ['error' => $e];

        }

        return  View::make('GenTmpAccAndAddress.finish');
    }

}