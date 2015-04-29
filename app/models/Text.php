<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 6:20
 */
class Text extends Eloquent
{

    protected $table = 'advert_text';

    protected $fillable = array('text', 'tmp_object');

    public static function updateText($id, $text, $tmp_object)
    {
        $id = (int)$id;
        $data = Text::findOrFail($id);
        $data->text = $text;
        $data->tmp_object = $tmp_object;
        return $data->save();
    }
}