<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 6:20
 */
class TextController extends BaseController
{

    public function index()
    {

        $date = Text::get()->all();

        return View::make('Text.list')->with(['texts' => $date]);
        //$str = substr($str,0,100) //выводим 100 первых знаков
    }


    public function create()
    {
        $data = Input::all();


        $validate = Validator::make(
            $data,
            [
                'text' => 'required|min:5',
            ]
        );

        if ($validate->failed()) {
            echo $validate->messages();
            return 'Error';
        } else {
            try {
                $text = Text::create(
                    [
                        'text' => $data['text'],
                        'tmp_object' => $data['tmp_object'],
                    ]
                );

                return Redirect::to('text')->with('status', 'Текст создан!');
            } catch (Exception $e) {
                return Redirect::to('text')->with('status', 'Текст уже существует!');
            }
        }
    }


    public function text($id)
    {
        $id = (int)$id;

        try {
            $data = Text::findOrFail($id);

            return View::make('Text.edit')->with(['text' => $data]);
        } catch (Exception $e) {
            return 'Error! No Text';
        }
    }

    public function edit()
    {
        $data = Input::all();


        $validate = Validator::make(
            $data,
            [
                'text' => 'required|min:5'
            ]
        );



        if ($validate->fails()) {
            return Redirect::to('text')->with('status', 'Текст не изменены!');
        }


        Text::updateText($data['id'], $data['text'], $data['tmp_object']);

        return Redirect::to('text')->with('status', 'Текст изменены успешно!');

    }


    public function del($id){

        $user = Text::findOrFail($id);
        $user->delete();
        return Redirect::to('text')->with('status', 'Текст удален Успешно!');
    }
}