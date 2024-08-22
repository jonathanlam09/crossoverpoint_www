<?php
namespace App\Http\Controllers;

use Helper;
use Exception;

class IndexController extends Controller
{
    protected $auth;

    public function __construct(){
        $client_id = env("REVENUE_MONSTER_CLIENT_ID");
        $client_secret = env("REVENUE_MONSTER_CLIENT_SECRET");
        $this->auth = base64_encode($client_id.":".$client_secret);
    }

    public function generate_signature($method, $url, $nonceStr, $timestamp, $payload = [])
    {
        $fp = fopen("private.pem", "r");
        $pem = fread($fp, 8192);
        fclose($fp);
        $res = openssl_pkey_get_private($pem);
        $signType = 'sha256';

        $arr = array();
        if (is_array($payload)) {
            $data = '';
            if (!empty($payload)) {
                ksort($payload);
                $data = base64_encode(json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_TAG));
                array_push($arr, "data=$data");
            }
        }
        
        array_push($arr, "method=$method");
        array_push($arr, "nonceStr=$nonceStr");
        array_push($arr, "requestUrl=$url");
        array_push($arr, "signType=$signType");
        array_push($arr, "timestamp=$timestamp");

        $signature = '';
        // compute signature
        openssl_sign(join("&", $arr), $signature, $res, OPENSSL_ALGO_SHA256);

        // free the key from memory
        unset($res);
        $signature = base64_encode($signature);
        return $signature;
    }

    public function authenticate(){
        $client_id = env("REVENUE_MONSTER_CLIENT_ID");
        $client_secret = env("REVENUE_MONSTER_CLIENT_SECRET");
        $authorization = base64_encode($client_id.":".$client_secret);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Basic $authorization"
        ];

        $ch = curl_init();
        $body = [
            "grantType" => "client_credentials"
        ];

        curl_setopt($ch, CURLOPT_URL, "https://sb-oauth.revenuemonster.my/v1/token");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $result = json_decode($response);
        // return $/
        $access_token = $result->accessToken;
        $refresh_token = $result->refreshToken;
        $bearer_exp = $result->expiresIn;
        $refresh_exp = $result->refreshTokenExpiresIn;
    }

    public function payment($data){
        $ch = curl_init();
        // $body = [
        //     "customer" => [
        //         "countryCode" => "60",
        //         "email" => "jonathan@gmail.com",
        //         "userId" => "test",
        //     ],
        //     "method" => [],
        //     "notifyUrl" => "https://google.com",
        //     "order" => [
        //         "additionalData" => "nothing",
        //         "amount" => 1000,
        //         "currencyType" => "MYR",
        //         "detail" => "hello",
        //         "id" => "1685707251658480029",
        //         "title" => "testing123"
        //     ],
        //     "redirectUrl" => "https://google.com",
        //     "storeId" => "1685583018824432667",
        //     "type" => "WEB_PAYMENT",
        //     "layoutVersion" => "v3",
        // ];
        $nonce_str = Helper::generateRandomString(32);
        $timestamp = time();
        $signature = $this->generate_signature("post", "https://sb-open.revenuemonster.my/v3/payment/online", $nonce_str, $timestamp, $data["payload"]);

        $headers = [
            "Authorization: Bearer " . $data["access_token"],
            "Content-type: application/json",
            "X-Signature: sha256 $signature",
            "X-Nonce-Str: $nonce_str",
            "X-Timestamp: $timestamp"
        ];
        // $content = ksort($body);

        // $string = "data=" . base64_encode($data) . "&method=post&nonceStr=$nonceStr&requestUrl=https://sb-open.revenuemonster.my/v3/payment/online&signType=sha256&timestamp=$timestamp";
        curl_setopt($ch, CURLOPT_URL, "https://sb-open.revenuemonster.my/v3/payment/online");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data["payload"]));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $result = json_decode($response);

        if($result->code != "SUCCESS"){
            throw new Exception($result->message);
        }
    }
}



    

    

    

    

