<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 16.01.15
 * Time: 8:20
 */

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class AdvertAvito extends Eloquent
{
    protected $table = 'advert';
    protected $fillable = array('tel_id', 'type_object', 'advert_id', 'show_all', 'show_today', 'status', 'red', 'bal', 'address_id');

    public static function index()
    {
        return AdvertAvito::join('avito_accaunt', 'advert.tel_id', '=', 'avito_accaunt.id')
            ->select('advert.id')
            ->get();
    }

    public static function upparam($id, $param, $value)
    {
        $d = AdvertAvito::findOrFail($id);
        $d->$param = $value;
        return $d->save();
    }
}