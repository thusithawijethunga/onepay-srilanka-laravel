<?php

namespace App\Utility;

use Session;
use Illuminate\Support\Facades\Cache;

class OnepayUtility {

    public static function api_url() {
        return 'https://merchant-api-live-v2.onepay.lk/api/ipg/gateway/request-transaction/?hash=';
    }

    public static function clean($string) {
        $string1 = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string1); // Removes special chars.
    }

    public static function create_checkout_form() {
        return view('checkout_form');
    }

    public static function create_notify_form() {
        $cache_key = 'onepay_callback';

        $payment_callback = Cache::has($cache_key);
        $payment_status = null;

        if ($payment_callback) {
            $payment_status = Cache::get($cache_key);
        }
        
        return view('notify_form', ['payment_callback' => $payment_callback, 'payment_status' => $payment_status]);
    }

    /*
     * @link https://merchant-v2.onepay.lk/#/pages/ipg-developer/app
     */

    public static function checkout_request($reference, $amount, $first_name, $last_name, $phone, $email) {

        if ($amount < 100) {
            Session::flash('error', "Minimum Amount is LKR 100 OnePay Accept!");
            return redirect('/checkout');
        }

        $firstname = OnepayUtility::clean($first_name);
        $lastname = OnepayUtility::clean($last_name);

        $app_id = env('ONEPAY_APP_ID'); //Onepay - App ID
        $hash_salt = env('ONEPAY_HASH_SALT'); //Onepay - Hash Salt
        $app_token = env('ONEPAY_APP_TOKEN'); //Onepay - App Token

        $onepay_args = array(
            "amount" => floatval($amount),
            "app_id" => $app_id,
            "reference" => "{$reference}",
            "customer_first_name" => $firstname,
            "customer_last_name" => $lastname,
            "customer_phone_number" => $phone,
            "customer_email" => $email,
            "transaction_redirect_url" => url(env('ONEPAY_REDIRECT_URL')),
        );

        $data = json_encode($onepay_args, JSON_UNESCAPED_SLASHES);

        $data_json = $data . "" . $hash_salt;

        $hash_result = hash('sha256', $data_json);

        $curl = curl_init();
        $url = OnepayUtility::api_url();
        $url .= $hash_result;

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization:' . "" . $app_token,
                'Content-Type:application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $result = json_decode($response, true);

        if (isset($result['data']['gateway']['redirect_url'])) {
            $re_url = $result['data']['gateway']['redirect_url'];
            return redirect($re_url);
        } else {
            Session::flash('error', $result['message']);
            return redirect('/checkout');
        }
    }

}
