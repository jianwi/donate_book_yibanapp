<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use \Illuminate\Support\Str;
use App\User;

class Yiban extends Controller
{
    //

    private $key;
    private $secret;
    private $app_url;

    private $postStr;

    public function index(Request $request)
    {
        $this->key = config('yiban.key');
        $this->secret = config('yiban.secrect');
        $this->app_url = config('yiban.url');
        $this->postStr = pack("H*", $request->get('verify_request'));


        if (!$this->postStr) {
            return redirect($this->app_url);
        }


        $token_info = $this->get_token_info();

        return $this->web_auth($token_info);
    }

    /**
     * web授权
     * @param $token_info
     * @return \Illuminate\Http\RedirectResponse
     */
    private function web_auth($token_info)
    {
        $yb_uid = $token_info['visit_user']['userid'];
        $token =    Str::random(80);
        $hash_token = hash('sha256',$token);
        if (User::where('yb_uid',$token_info['visit_user']['userid'])->first()){
            $user = User::where('yb_uid',$yb_uid)->first();
            $user->api_token =  $hash_token;
            $user->save();
        }else{
            $user = User::forceCreate([
                'yb_uid' => $yb_uid,
                'api_token' => $hash_token
            ]);
        }
        auth()->login($user);
        Cookie::queue(cookie()->make("token",$token,"120","/"));
        return redirect()->route('home');
    }


    public function get_token_info()
    {
        $postInfo = openssl_decrypt(
            $this->postStr,
            "AES-256-CBC",
            $this->secret,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $this->key
        );
        $postInfo = rtrim($postInfo);
        $token_info = json_decode($postInfo, true);

        if (!$token_info['visit_oauth']){
            return $this->get_authorize();
        }
        return $token_info;
    }

    private function get_authorize()
    {
        $query = http_build_query([
            "client_id" => $this->key,
            "redirect_uri" => $this->app_url,
        ]);
         header("Location: https://openapi.yiban.cn/oauth/authorize?".$query);
        die();
    }

}
