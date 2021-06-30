<?php

namespace Src\Controller;

class Controller
{

    public $response;
    public $result;

    public function http_response($result)
    {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }
}
