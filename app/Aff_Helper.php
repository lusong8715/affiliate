<?php
use App\Models\SasConfig;
use App\Models\CjConfig;

class Aff_Helper
{
    public static function callSasApi($action, $data=array()) {
        $config = SasConfig::Find(1);
        if ($config->merchant_id) {
            $param = '';
            if (is_array($data) && !empty($data)) {
                foreach ($data as $key => $val) {
                    $param .= "&$key=$val";
                }
            }
            $url = $config->api_url . '?merchantId=' . $config->merchant_id . '&token=' . $config->api_token . '&version=' . $config->api_version . '&action=' . $action . '&format=xml' . $param;
            $myTimeStamp = gmdate(DATE_RFC1123);
            $sig = $config->api_token.':'.$myTimeStamp.':'.$action.':'.$config->api_secret;
            $sigHash = hash("sha256",$sig);
            $myHeaders = array("x-ShareASale-Date: $myTimeStamp","x-ShareASale-Authentication: $sigHash");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$myHeaders);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

            $output = curl_exec($ch);

            if (!$output) {
                Log::debug("Call api $action Error: " . curl_error($ch));
                curl_close($ch);
                return false;
            }
            curl_close($ch);
            if (stripos($output,"Error Code ")) {
                Log::debug("Sas Api $action Error: " . $output);
                return false;
            }
            return $output;
        } else {
            return false;
        }
    }

    public static function callCjApi($start='', $end='') {
        $config = CjConfig::Find(1);
        if ($config->api_key) {
            $param = '';
            if ($start) {
                $param = '&start-date=' . $start;
            }
            if ($end) {
                $param .= '&end-date=' . $end;
            }
            $url = $config->api_url . '?date-type=posting' . $param;
            $myHeaders = array("authorization: $config->api_key");

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER,$myHeaders);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

            $output = curl_exec($ch);
            curl_close($ch);

            if (strpos($output, '<cj-api>') === false) {
                Log::debug("Call CJ Api Error: " . $output);
                return false;
            }
            return $output;
        } else {
            return false;
        }
    }
}

