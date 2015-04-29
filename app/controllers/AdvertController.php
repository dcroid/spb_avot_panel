<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 16.01.15
 * Time: 8:02
 */
class AdvertController extends BaseController
{

    public function index()
    {

        $data = AdvertAvito::join('avito_accaunt', 'advert.tel_id', '=', 'avito_accaunt.id')->join('advert_address','advert.address_id', '=', 'advert_address.id')
            ->select([
                'advert.id',
                'advert.type_object',
                'advert.advert_id',
                'advert.show_today',
                'advert.show_all',
                'advert.status',
                'advert.bal',
                'advert.red',
                'advert.created_at',
                'avito_accaunt.tel',
                'avito_accaunt.email',
                'avito_accaunt.password',
                'avito_accaunt.tmp_typeobj',
                'advert_address.address',
                'advert_address.metro_id'
            ])
            ->whereNull('deleted')->orderBy('advert.id', 'DESC')->paginate(300);



        return View::make('Advert.list')->with(['adverts' => $data, 'stat'=> $this->statistic()]);
    }

    public function deleted()
    {
        $data = AdvertAvito::join('avito_accaunt', 'advert.tel_id', '=', 'avito_accaunt.id')
            ->select([
                'advert.id',
                'advert.type_object',
                'advert.advert_id',
                'advert.show_today',
                'advert.show_all',
                'advert.status',
                'advert.bal',
                'advert.red',
                'avito_accaunt.tel',
                'avito_accaunt.email',
                'avito_accaunt.password',
                'avito_accaunt.tmp_typeobj',
            ])
            ->whereNotNull('deleted')->orderBy('advert.id', 'DESC')->paginate(300);

        return View::make('Advert.list')->with(['adverts' => $data]);
    }

    public function del($id)
    {

        $user = AdvertAvito::findOrFail($id);
        $user->deleted = 1;
        $user->save();
        return Redirect::to('advert')->with('status', 'Строка удалена');
    }

    public function redbal()
    {
        $data = Input::all();

        if (isset($data['actionCheckBox']) && isset($data['id'])) {
            if (AdvertAvito::upparam($data['id'], $data['param'], $data['actionCheckBox']))
                return 1;
            return 0;
        }
    }


    public static function statistic(){

        $start = new \DateTime('now');

        $end = new \DateTime('now');
        $end->modify( '-15 day' );


        return [
            'one'=> [
                'base'=> AdvertAvito::where('type_object','=',1,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'elit' => AdvertAvito::where('type_object','=',4,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'sum_show' =>
                    [
                        AdvertAvito::where('type_object','=',1,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',1,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                        AdvertAvito::where('type_object','=',4,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',4,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                    ]

            ],
            'two'=>[
                'base'=> AdvertAvito::where('type_object','=',2,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'elit' => AdvertAvito::where('type_object','=',5,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'sum_show' =>
                    [
                        AdvertAvito::where('type_object','=',2,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',2,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                        AdvertAvito::where('type_object','=',5,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',5,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                    ]
            ],
            'tree'=>[
                'base'=> AdvertAvito::where('type_object','=',3,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'elit' => AdvertAvito::where('type_object','=',6,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'sum_show' =>
                    [
                        AdvertAvito::where('type_object','=',3,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',3,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                        AdvertAvito::where('type_object','=',6,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',6,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                    ]
            ],
            'com' => [
                'base'=> AdvertAvito::where('type_object','=',7,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->count('id'),
                'sum_show' =>
                    [
                        AdvertAvito::where('type_object','=',7,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_all'),
                        AdvertAvito::where('type_object','=',7,'and')->where('status', '=', 1, 'AND')->whereNull('deleted')->sum('show_today'),
                    ]
            ],
        ];

    }
}