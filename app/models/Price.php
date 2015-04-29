<?php
/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 7:21
 */

class Price extends Eloquent
{

    protected $table = 'advert_price';

    protected $fillable = array('type_object', 'price');

    public static function updatePrice($id, $price)
    {
        $id = (int)$id;
        $data = Price::findOrFail($id);
        $data->price = $price;
        return $data->save();
    }
}