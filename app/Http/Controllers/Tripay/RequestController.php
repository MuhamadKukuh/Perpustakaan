<?php

namespace App\Http\Controllers\Tripay;

use App\Http\Controllers\Controller;
use App\Models\view;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function Request (){

$apiKey = 'DEV-Z43CP26mVEPJRxbfLDooR7KhsGleaGgvpl4kdPCl';

$payload = ['code' => 'BRIVA'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_FRESH_CONNECT  => true,
  CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel?'.http_build_query($payload),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HEADER         => false,
  CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
  CURLOPT_FAILONERROR    => false,
  CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
));

$response = curl_exec($curl);
$error = curl_error($curl);

curl_close($curl);

$response ? $response : $error;

// dd($response);

return view('try', compact('response'));

    }
}
