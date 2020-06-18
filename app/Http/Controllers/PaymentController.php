<?php

namespace App\Http\Controllers;

use Crypto;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $working_key = 'CB669E2A86DB6C47DE75F6362C8D7ACB';
        $access_code = 'AVND03HD40AZ34DNZA';
        $price = $request->session()->get('price');
        $data['merchant_id'] = 45990;
        $data['order_id'] = str_pad(uniqid(), 8, "0", STR_PAD_LEFT);
        $data['currency'] = 'AED';
        $data['amount'] = (int) $price;
        $data['redirect_url'] = route('payment.response');
        $data['cancel_url'] = route('payment.response');
        $data['language'] = 'EN';
        $merchant_data = '';
        foreach ($data as $key => $value) {
            $merchant_data .= $key . '=' . $value . '&';
        }
        $encrypted_data = Crypto::encrypt($merchant_data, $working_key);
        return view('payment', compact('price', 'encrypted_data', 'access_code'));
    }

    public function response(Request $request)
    {
        $encResponse = $request->encResp;
        $working_key = 'CB669E2A86DB6C47DE75F6362C8D7ACB';
        $access_code = 'AVND03HD40AZ34DNZA';
        $rcvdString = Crypto::decrypt($encResponse, $working_key);
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);
        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3)    $order_status = $information[1];
        }
        if ($order_status === "Success") {
            $status = 'status';
            $message =  "Your transaction was successful.";
        } else if ($order_status === "Aborted") {
            $status = 'error';
            $message =   "Your transaction was aborted.";
        } else if ($order_status === "Failure") {
            $status = 'error';
            $message =   "Your transaction was not successful.";
        } else {
            $status = 'error';
            $message =   "Security Error. Illegal access detected";
        }
        return redirect(route('product'))->with($status, $message);
    }
}
