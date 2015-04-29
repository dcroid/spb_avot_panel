<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 3:27
 */
class UserController extends BaseController
{

    public function index($message = false)
    {
        $date = User::get()->all();

        return View::make('User.list')->with(['message' => $message, 'users' => $date]);
    }

    public function add()
    {
        return View::make('User.create');
    }

    public function create()
    {
        $data = Input::all();


        $validate = Validator::make(
            $data,
            [
                'email' => 'required|min:5|unique',
                'password' => 'required|min:5',
            ]
        );

        if ($validate->failed()) {
            echo $validate->messages();
            return 'Error';
        } else {
            try {
                User::create([
                        'email' => $data['email'],
                        'password' => Hash::make($data['password'])
                    ]
                );

                return Redirect::to('user')->with('status', 'Пользователь Зарегистрирован!');
            } catch (Exception $e) {
                return Redirect::to('user')->with('status', 'Пользователь уже существует!');
            }

        }

    }


    public function user($id)
    {
        $id = (int)$id;

        try {
            $data = User::findOrFail($id);

            return View::make('User.edit')->with(['user' => $data]);
        } catch (Exception $e) {
            return 'Error! No User';
        }
    }


    public function edit()
    {
        $data = Input::all();


        $validate = Validator::make(
            $data,
            [
                'email' => 'required|min:5',
                'password' => 'required|min:5',
            ]
        );


        if ($validate->fails()) {
            return Redirect::to('user')->with('status', 'Данные пользователя не изменены!');
        }


        User::updateUser($data['id'], $data['email'], $data['password']);

        return Redirect::to('user')->with('status', 'Данные пользователя "' . $data['email'] . '" изменены успешно!');

    }

    public function del($id)
    {

        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::to('user')->with('status', 'Пользователь удален Успешно!');
    }


    public function login()
    {
        $data = Input::all();


        $valodation = Validator::make(
            $data,
            [
                'email' => 'required|min:5',
                'password' => 'required|min:5',

            ]);


        if ($valodation->failed()) {
            return Redirect::to('/')->with('status', 'Автризация не удалась');
        }

        $user = User::login($data);


        if (!$user) {
            return Redirect::to('/')->with('status', 'Ошибка авторизации');
        }

        Auth::login($user, true);

        return Redirect::to('/advert')->with('status', 'Добро пожаловать');
    }

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/')->with('status', 'Всего доброва');
    }

}