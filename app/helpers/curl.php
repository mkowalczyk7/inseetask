<?php
namespace App\Helpers;

/**
 * CURL HELPER
 * @package App\Helpers
 */
class Curl
{
    /**
     * Make API call
     * @param string $url
     * @return mixed
     */
    public static function callAPI(string $url)
    {
        $curl = curl_init();

        // Options
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'User-Agent: mkowalczyk7',
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        // Execute
        $result = curl_exec($curl);

        if (!$result) {
            die("CURL Connection Failure");
        }

        curl_close($curl);

        // Return decoded json response
        return json_decode($result);
    }
}
