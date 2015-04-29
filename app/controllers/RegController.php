<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 8:55
 */
class RegController extends BaseController
{
    public function index()
    {
        $data = Price::get()->all();

        return View::make('RegAcc.step_one')->with(['type_objects' => $data]);
    }

    public function step_two()
    {

        $data = Input::all();

        $validator = Validator::make(
            $data,
            [
                'tel' => 'required|min:11|max:11',
                'type_object' => 'required|min:1|max:1'
            ]
        );


        if ($validator->fails()) {
            return Redirect::to('reg')->with('status', 'Какое-то поле заполнено не верно!');
        }

        // TODO добавить пользователя после авторизации
        try {
            $acc = AvitoAcc::create([
                'tel' => $data['tel'],
                'user_id' => $data['id'],
                'tmp_typeobj' => $data['type_object']
            ]);
            return View::make('RegAcc.step_two')->with(['acc' => $acc]);
        } catch (Exception $e) {
            return Redirect::to('reg')->with('status', 'Аккаунт уже был зарегистрирован ранее!');
        }


    }

    public function finish()
    {
        $data = Input::all();

        if ($data['code'] == 0)
            return Redirect::to('reg')->with('status', 'Вы отказались от регистрации аккаунта(наверное не пришла sms)!');

        $validator = Validator::make(
            $data,
            [
                'code' => 'required|min:1|max:10',
                'acc_id' => 'required|min:1|max:11'
            ]
        );

        if ($validator->fails()) {
            return 'Error';
        }

        $acc = AvitoAcc::updateAcc($data['acc_id'], $data['code']);
        return View::make('RegAcc.finish')->with([]);
    }
}