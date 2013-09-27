<?php

namespace attitude\Elements;

use \Exception;

class HTTPException extends Exception
{
    /**
     * @var array HTTP response codes and messages
     */
    protected static $statuses = array(
        //Informational 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        //Successful 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        //Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        //Client Error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Largse',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        422 => 'Unprocessable Entity',
        423 => 'Locked',
        //Server Error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported'
    );

    private $headers = array();

    public function __construct($code, $message = null, HTTPException $previous = null)
    {
        if (!is_int($code)) {
            debug_print_backtrace(2);
            trigger_error('HTTP HTTPException must pass a integer code by default. Die.', E_USER_ERROR);
        }

        if (empty($message)) {
            if (!isset(self::$statuses[$code])) {
                trigger_error('You must provide a custom message with your custom code', E_USER_ERROR);
            } else {
                $message =& self::$statuses[$code];
            }
        }

        return parent::__construct($message, $code, $previous);
    }

    /**
     * Sets header according to provided status number
     *
     * @param int $status Valid HTTP status code
     * @returns mixed           String response or false
     *
     */
    public function header($header=null)
    {
        if ($header!==null) {
            if (is_string($header)) {
                $this->headers[] = $header;
            }

            return;
        }

        if (!headers_sent()) {
            header("HTTP/1.1 ".$this->getCode().' '.$this->getMessage());

            foreach ($this->headers as &$header) {
                header($header);
            }
        }

        return false;
    }

    /**
     * Returns HTTP Status based on code number
     *
     * @param   string|int  $code
     * @returns string
     *
     */
    public static function getStatus($code)
    {
        if (is_numeric($code)) {
            $code = (int) $code;
        }

        if (!is_int($code) || !isset(self::$statuses[$code])) {
            throw new \Exception('Wrong status code');
        }

        return self::$statuses[$code];
    }
}
