<?php

    namespace App\Providers\Constants;

    use App\Providers\Constants\Base\Constants;

    class ApiConstants extends Constants
    {

        const STATUS_OK                    = 200;

        const STATUS_CREATED               = 201;

        const STATUS_ACCEPTED              = 202;

        const STATUS_NO_CONTENT            = 204;

        const STATUS_MOVED_PERMANENTLY     = 301;

        const STATUS_FOUND                 = 302;

        const STATUS_SEE_OTHER             = 303;

        const STATUS_NOT_MODIFIED          = 304;

        const STATUS_BAD_REQUEST           = 400;

        const STATUS_UNAUTHORIZED          = 401;

        const STATUS_PAYMENT_REQUIRED      = 402;

        const STATUS_FORBIDDEN             = 403;

        const STATUS_NOT_FOUND             = 404;

        const STATUS_METHOD_NOT_ALLOWED    = 405;

        const STATUS_NOT_ACCEPTABLE        = 406;

        const STATUS_REQUEST_TIMEOUT       = 408;

        const STATUS_CONFLICT              = 409;

        const STATUS_INTERNAL_SERVER_ERROR = 500;

        const STATUS_NOT_IMPLEMENTED       = 501;

        const STATUS_BAD_GATEWAY           = 502;


        const MSG_INTERNAL_SERVER_ERROR = 'Unexpected internal server error.';

        const MSG_METHOD_NOT_ALLOWED    = 'Method not allowed.';

        const SUCCESS                   = 'success';

        const ERROR                     = 'error';

        const RESPONSE                  = '_response';


    }



