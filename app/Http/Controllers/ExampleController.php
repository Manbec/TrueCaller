<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * GET
     *
     * /{Phone}
     *
     * @return {
     *   "first_name" : "Armando",
     *   "last name" : "Gtrz",
     *   "country" : "Mexico",
     *   "gender" : "Male",
     *   "alternate_name" : "Mando"
     * }
     *
     */
    public function getPhoneFromTrueCaller($phone)
    {

        var_dump($phone);

        $client = new Client([
            // Base URI is used with relative requests
            "base_uri" => "https://api4.truecaller.com/v1/apps/requests",
            // You can set any number of default request options.
            "timeout"  => 5.0,
        ]);

        // Provide the body as a string.
        $response= $client->request("POST", "https://api4.truecaller.com/v1/apps/requests", [
            "phoneNumber" => $phone,
            "headers" => [
                "Content-Type" => "application/json",
                "appKey" => env("TRUECALLER_KEY")
            ]
        ]);

        $body = $response->getBody();

        var_dump($body->getContents());
        $trueCallerProfile = json_decode($body->getContents());

        return $trueCallerProfile;

        return [
            "first_name" => "Armando",
            "last name" => "Gtrz",
            "country" => "Mexico",
            "gender" => "Male",
            "alternate_name" => "Mando"
        ];

    }


}
