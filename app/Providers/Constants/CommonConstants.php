<?php
    namespace App\Providers\Constants;

    /**
     * Created by PhpStorm.
     * User: tnchalise
     * Date: 23/12/15
     * Time: 12:55 PM
     */

    use \App\Providers\Constants\Base\Constants;

    class CommonConstants extends Constants
    {

        /**
         * User Status
         */

        const STATUS_ONLINE  = 1;

        const STATUS_OFFLINE = 0;

        /**
         * Device Types
         */
        const DEVICE_IPHONE  = 'iphone';

        const DEVICE_ANDROID = 'android';

        const DEVICE_WINDOW  = 'window';

        /**
         * Notification Types
         */
        const  NOTIFICATION_TYPE_LOGIN = 'login';

        const  REFILL_NOTIFICATION     = 'refill';


        const  DELIVERED_NOTIFICATION = 'delivered';

        const  NOTIFICATION_READ      = 1;

        const  NOTIFICATION_LIMIT     = 10;

        const  NOTIFICATION_PAGE_SIZE = 10;


    }
