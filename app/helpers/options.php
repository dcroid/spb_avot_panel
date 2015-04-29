<?php

/**
 * Created by PhpStorm.
 * User: ssl
 * Date: 20.09.14
 * Time: 6:24
 */
class options
{

    static function gen($min = 6, $max = 9)
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp";

        $max = rand($min, $max);
        $size = StrLen($chars) - 1;
        $password = null;
        while ($max--)
            $password .= $chars[rand(0, $size)];

        return $password . rand(1,999);
    }

    static function genEmail()
    {
        $email_domain = array(
            'rambler.ru', 'yandex.ru', 'mail.ru', 'yahoo.com', 'narod.ru', 'bk.ru', 'list.ru','googlemail.com','gmail.com'
        );

        return self::gen() . rand(1950,2015) . '@' . $email_domain[array_rand($email_domain)];
    }

    static function name()
    {
        return options::randName();
    }

    static function genTel()
    {
        $tel_code = array(
            902, 903, 904, 905, 906, 907, 908, 909, 910, 911, 912, 913, 914, 915, 916, 917, 918, 919, 920, 921, 922, 923, 924, 925, 926, 927, 928, 929, 930, 931,
            937, 950, 951, 952, 954, 961, 962, 963, 964, 980, 981, 982, 983, 985, 987, 988
        );
        //79212409475
        // return '8' . $tel_code[array_rand($tel_code)] . rand(100, 999) . rand(10, 99) . rand(10, 99);
        return '8999' .  rand(240, 999) . rand(10, 99) . rand(10, 99);
    }

    static function randFile($dir = '')
    {

        $d = opendir($dir);
        $filelist = array();
        while ($filename = readdir($d)) {
            if ($filename != '.' && $filename != '..') {
                $filelist[] = $filename;
            }
        }



        closedir($d);
        $rand = array_rand($filelist);
        return $dir . '/' . $filelist[$rand];

    }

    static function randRealTelTel()
    {

        $tel = array(

             '+7(812)425-34-49',
             '8(812)425-34-49',
             '+7(812) 425-34-49',
             '+7(812)425-34-49',
             '8(812)425-34-49',
             '+7(812) 425-3 4-49',
             '+7(812)4 2 5-34-49',
             '+7( 812 )425-34-49',
             '+7 (812) 425 - 34 - 49',
             '+7 ( 8 1 2 ) 4 2 5 - 3 4 - 4 9',
             '+7812425-34-49',
             '8(812)425-34-49',
             '8-812-425-34-49',
             '8-812-425-3449',
             '8-812-4253449',
             '8 812 425 34 49',
            '89650578439',
        );

        return $tel[array_rand($tel)];
    }

    static function randName()
    {
        $list_name = array('Алевтина',
            'Александра',
            'Алёна',
            'Алина',
            'Алиса',
            'Алия',
            'Алла',
            'Алсу',
            'Альбина',
            'Анастасия',
            'Ангелина',
            'Анжелика',
            'Анна',
            'Антонина',
            'Арина',
            'Ася',
            'Валентина',
            'Валерия',
            'Варвара',
            'Василиса',
            'Вера',
            'Вероника',
            'Виктория',
            'Виолетта',
            'Виталия',
            'Галина',
            'Дана',
            'Дарья',
            'Диана',
            'Дина',
            'Динара',
            'Ева',
            'Евгения',
            'Екатерина',
            'Елена',
            'Елизавета',
            'Жанна',
            'Земфира',
            'Зинаида',
            'Зоя',
            'Инга',
            'Инесса',
            'Инна',
            'Ирина',
            'Кира',
            'Карина',
            'Кристина',
            'Ксения',
            'Лариса',
            'Лидия',
            'Лилия',
            'Любовь',
            'Людмила',
            'Майя',
            'Маргарита',
            'Марина',
            'Мария',
            'Марианна',
            'Марьяна',
            'Надежда',
            'Наталья',
            'Нина',
            'Нонна',
            'Оксана',
            'Олеся',
            'Ольга',
            'Полина',
            'Раиса',
            'Регина',
            'Римма',
            'Роза',
            'Светлана',
            'Софья',
            'Таисия',
            'Тамара',
            'Татьяна',
            'Ульяна',
            'Элина',
            'Эльвира',
            'Юлия',
            'Яна',
        );

        return trim($list_name[array_rand($list_name)]);
    }

    static function timer(){
        $time_start = new DateTime(date("Y-m-d 4:00:00"));

        $time_finish = new DateTime(date("Y-m-d 20:30:00"));

        $time_now = new DateTime("now");

        if ($time_start < $time_now && $time_now < $time_finish) {
            echo "Good Working Day\n";
            return true;
        } else{
            echo "NOW : "; var_dump($time_now); echo "\n";

            sleep(10);
            self::timer();
        }

    }


}

