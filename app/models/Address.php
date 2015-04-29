<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 16.01.15
 * Time: 6:17
 */
class Address extends Eloquent
{
    protected $table = 'advert_address';
    protected $fillable = array('metro_id', 'address', 'object_type');

    public static function updateAddress($id, $metro_id, $address, $object_type){
        $id = (int)$id;
        $data = Address::findOrFail($id);


        $data->metro_id = $metro_id;
        $data->address = $address;
        $data->object_type = $object_type;

        return $data->save();
    }
}