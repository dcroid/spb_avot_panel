<?php
/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 7:21
 */

class PriceController  extends BaseController{

    public function index()
    {
        $data = Price::get()->all();

        return View::make('Price.list')->with(['prices' => $data]);
        //$str = substr($str,0,100) //выводим 100 первых знаков
    }

    public function edit(){
        $data = Input::all();


        foreach($data['price'] as $k=>$p){
            Price::updatePrice($data['id'][$k], $data['price'][$k]);
        }

        return Redirect::to('price')->with('status', 'Цены обновлены');
    }
}