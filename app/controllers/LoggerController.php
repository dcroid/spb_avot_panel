<?php
/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 15.01.15
 * Time: 8:09
 */

class LoggerController extends BaseController{

    public function index(){
        $data = PosterLogger::orderBy('id', 'desc')->paginate(30);

        return View::make('Logger.list')->with(['logs'=>$data]);
    }

    public function poster($id){
        $data = PosterLogger::where('poster_id', '=', $id)->orderBy('id', 'desc')->paginate(30);
        return View::make('Logger.list')->with(['logs'=>$data]);
    }
}