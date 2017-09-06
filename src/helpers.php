<?php

/**
 * A wrapper class to standard the response data.
 */
class Respond extends \Slim\Http\Response
{
    private $res;

    function __construct(\Slim\Http\Response $res) {
        $this->res = $res;
    }

    function ok($data = null)
    {
        return $this->res->withJson([
            'success' => true,
            'data' => $data
        ]);
    }

    function error($message = '', $status = 500)
    {
        return $this->res->withJson([
            'success' => false,
            'message' => $message
        ])->withStatus($status);
    }
}

if (! function_exists('respond')) {
    function respond($res)
    {
        return new Respond($res);
    }
}
