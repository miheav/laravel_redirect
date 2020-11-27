<?php

/**
 * @Author: aleks
 * @Date:   2020-11-11 07:55:32
 * @Last Modified by:   aleks
 * @Last Modified time: 2020-11-27 11:13:47
 */
namespace App\Http\Controllers;
use App\UrlModel;
use Illuminate\Http\Request;
/**
 *
 */
class MainController extends Controller
{

    public function index(Request $request)
    {
        $url = $request->get('url');
        $redir = $request->get('redir');
        if($redir) {
            return Redirect::to($redir);
        }

        if(!$url) {
            $result = '';
            return view('welcome',['url' => '','result' => $result]);
        } else {
            $model = new UrlModel($url);
            $result = $model->generateHash();
            return view('welcome',['url' => $url,'result' => $result]);
        }
    }
}


