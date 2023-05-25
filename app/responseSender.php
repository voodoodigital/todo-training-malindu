<?php

class ResponseSender
{
    public static function send($responseObject)
    {
        $responseJsonText = json_encode($responseObject);
        echo $responseJsonText;
        exit();
    }
}
