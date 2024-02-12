<?php

namespace Travis;

class SimpleTexting
{
    public static function run($apikey, $method, $payload)
    {
        // set endpoint
        $endpoint = 'https://api-app2.simpletexting.com/v2/api/'.$method;

        $payload = json_encode($payload);

        // setup curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer '.$apikey,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // catch error...
        if (curl_errno($ch))
        {
            // report
            #$errors = curl_error($ch);

            // close
            curl_close($ch);

            // return false
            return false;
        }

        // close
        curl_close($ch);

        // catch error...
        if (!in_array($httpcode, [200, 201, 202]))
        {
            // decode
            $decoded = json_decode($response);

            // throw error
            throw new \Exception(ex($decoded, 'error', 'Request failed with HTTP code '.$httpcode));

            // return false
            return false;
        }

        // decode response
        return json_decode($response);
    }
}