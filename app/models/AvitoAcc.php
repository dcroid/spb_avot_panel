<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 9:42
 */
class AvitoAcc extends Eloquent
{

    protected $table = 'avito_accaunt';
    protected $fillable = array('email', 'password', 'tel', 'code', 'user_id', 'tmp_typeobj', 'name');

    /**
     * Обновеление Кода смс
     * @param $id
     * @param $code
     */
    public static function updateAcc($id, $code)
    {
        $acc = AvitoAcc::findOrFail($id);
        $acc->code = $code;
        $acc->save();
    }

    public static function updateStepReg($id, $step_reg)
    {
        $acc = AvitoAcc::findOrFail($id);
        $acc->step_reg = $step_reg;
        $acc->save();
    }

    /**
     * Обновлеяем данные после регистрации
     * @param $id
     * @param $email
     * @param $password
     * @param $name
     */
    public static function updateAccBeforeReg($id, $email, $password, $name)
    {
        $acc = AvitoAcc::findOrFail($id);
        $acc->email = $email;
        $acc->password = $password;
        $acc->name = $name;
        $acc->save();
    }


}