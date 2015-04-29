<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 3:28
 */

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;


class User extends Eloquent  implements UserInterface, RemindableInterface
{

    use \Illuminate\Auth\UserTrait, \Illuminate\Auth\Reminders\RemindableTrait;

    protected $table = 'user';

    protected $fillable = array('email', 'password');


    public static function updateUser($id, $email, $password)
    {


        $id = (int)$id;
        $data = User::findOrFail($id);


        $data->email = $email;
        $data->password = Hash::make($password);

        return $data->save();
    }

    public static function login($data)
    {


        if (Auth::attempt(['email' => $data['email'],'password' => $data['password'] ], true)){
            return Auth::user();
        } else{
            return false;
        }
    }
}