<?php
/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 8:09
 */

class PosterLogger  extends Eloquent
{

    protected $table = 'logger';
    protected $fillable = array('poster_id', 'message');



}