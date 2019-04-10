<?php
/**
 * Created by PhpStorm.
 * User: gangelmark
 * Date: 2019. 04. 09.
 * Time: 19:29
 */

namespace AppBundle\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterSearch
{


    private $connection;

    public function getTweets($q, $lang, $type) {
        $statuses = $this->connection->get("search/tweets", [
            "q" => $q,
            "lang" => $lang,
            "result_type" => $type,
            "count" => 10
        ]);

        return json_decode(json_encode($statuses->statuses), true);


    }


    public function __construct()
    {
        $config = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/../config.json');
        $config = json_decode($config, true);


        $this->connection = new TwitterOAuth(
            $config['consumer_key'],
            $config['consumer_secret'],
            $config['access_token'],
            $config['access_token_secret']
        );

        $this->connection->get("account/verify_credentials");

    }


}