<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlModel extends Model
{
    protected $table = 'url';
    public $url;
    public static $keys = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];

    public function generateHash($url){
         $this->url = $url;
        if(!preg_match("#^http\w?\://.+?\.[a-z]+$#iu", $this->url))
            return "false";
        $quantitySymb = count(self::$keys) - 1;
        do {
            $string = '';
            for($i=0; $i<6; $i++) {
                $string.=self::$keys[random_int(0,$quantitySymb)];
            }
            $string = ("http://laravel5.tz/?redir=").$string;
        } while($this->where('short_url', '=', $string)->first());

        if($model = $this->where('url', '=', $this->url)->first()){
            return $model->short_url;
        } else {

            $this->short_url = $string;
            $this->save();
            return $this->short_url ;
        }

    }


}
