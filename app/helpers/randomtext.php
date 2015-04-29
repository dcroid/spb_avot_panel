<?php

/**
 * Created by PhpStorm.
 * User: andreyteterevkov
 * Date: 16.01.15
 * Time: 4:57
 */
class randomtext
{
    public  $text;
    public $resArray = array();


    function __construct($text = ''){}


    static function inic($text)
    {
        $randText = new randomtext;
        $randText->text = $text;
        $randText->tplTextToArray();
        return trim($randText->genText());
    }

    // выводим результат
    public function genText()
    {
        return $this->replaceText();
    }

    // на какие слова необходимо поменять
    public function tplTextToArray()
    {
        //preg_match_all('/\{(.*?)\}/', $this->text, $_arrText);
        if (preg_match_all('/\{(.*?)\}/', $this->text, $_arrText)) {
            foreach ($_arrText[1] as $key => $value) {
                $res[$key] = explode("|", $value);
            }
            if (is_array($res)) {
                $this->resArray = $res;
            } else {
                $this->resArray = false;
            }
        } else {
            $this->resArray = false;
        }
    }

    // замена шаблона на текст
    public function replaceText()
    {
        if ($this->resArray) {
            preg_match_all('/\{(.*?)\}/', $this->text, $_arrText);

            $resText = $this->text;
            foreach ($_arrText[0] as $key => $value) {
                $resText = preg_replace('/{(.*?)\}/', $this->resArray[$key][array_rand($this->resArray[$key], 1)], $resText, 1) . "\n";
            }
            return $resText;
        } else {
            return $this->text;
        }
    }
}