<?php

/**
 * @Author: aleks
 * @Date:   2020-11-11 07:55:32
 * @Last Modified by:   aleks
 * @Last Modified time: 2020-11-27 14:52:51
 */
namespace App\Http\Controllers;
use App\UrlModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
/**
 *
 */
class MainController extends Controller
{

    public function index(Request $request)
    {
        echo env('APP_URL');

        $url = $request->get('url');
        $redir = $request->get('redir');
        if($redir) {
            $model = UrlModel::where('short_url', (env('APP_URL')).'/?redir='.$redir)->first();
            return Redirect::to($model->url);
        }

        if(!$url) {
            $result = '';
            return view('welcome',['url' => '','result' => $result]);
        } else {
            $model = new UrlModel();
            $result = $model->generateHash($url);
            return view('welcome',['url' => $url,'result' => $result]);
        }
    }
}


