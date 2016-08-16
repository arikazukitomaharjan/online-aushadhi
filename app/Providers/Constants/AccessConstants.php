<?php
    /**
     * Created by PhpStorm.
     * User: tnchalise
     * Date: 23/12/15
     * Time: 12:51 PM
     */

    namespace App\Providers\Constants;


    use App\Providers\Constants\Base\Constants;

    class AccessConstants extends Constants
    {

        const ADMIN_DEFAULT_PAGE = 'access.users.default_per_page';
        const DEFAULT_ROLE       = 'access.users.default_role';

        /**
         * Permission constants.
         */
        const CAN_USER_CONFIRM_EMAIL = 'access.users.confirm_email';
        const CAN_USER_CHANGE_EMAIL  = 'access.users.change_email';
        const CAN_ADD_USER           = 'access.permissions.add_user';
        const CAN_EDIT_USER          = 'access.permissions.edit_user';
        const CAN_LIST_USER          = 'access.permissions.list_user';
        const CAN_VERIFY_USER        = 'access.permissions.verify_user';
        const CAN_POST_ADD           = 'access.permissions.post_add';
        const ADMIN_PERMISSIONS      = 'access.permissions';
    }