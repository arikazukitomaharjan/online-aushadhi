<?php

    namespace App\Providers\Constants;

    use App\Providers\Constants\Base\Constants;

    /**
     * Created by PhpStorm.
     * User: tnchalise
     * Date: 23/12/15
     * Time: 12:23 PM
     */
    class TableConstants extends Constants
    {
        const USER_TABLE                     = 'auth.table';
        const ROLE_TABLE                     = 'tables.role_table';
        const PASSWORD_RESET_TABLE           = 'tables.password_reset_table';
        const USER_ROLE_TABLE                = 'tables.user_role_table';
        const VERIFICATION_TABLE             = 'tables.verification_table';
        const DEVICE_TABLE                   = 'tables.device_table';
        const USER_INFO_TABLE                = 'tables.user_information_table';
        const PET_TABLE                      = 'tables.pet_table';
        const PETS_BEHAVIOUR_TABLE           = 'tables.pet_behaviour_table';
        const PET_TYPE_TABLE                 = 'tables.pet_type_table';
        const BEHAVIOUR_TABLE                = 'tables.behaviours_table';
        const INTERESTS_TABLE                = 'tables.interests_table';
        const USER_INTERESTS_TABLE           = 'tables.user_interest_table';
        const USER_ADDRESS_TABLE             = 'tables.user_address_table';
        const USER_LOCATION_TABLE            = 'tables.user_location_table';
        const LOCATION_TABLE                 = 'tables.location_table';
        const ALBUM_TABLE                    = 'tables.album_table';
        const IMAGES_TABLE                   = 'tables.images_table';
        const VIDEOS_TABLE                   = 'tables.videos_table';
        const FEED_TABLE                     = 'tables.feed_table';
        const FEED_OPTIONS_TABLE             = 'tables.feed_option_table';
        const REGISTRATION_TEMP_TABLE        = 'tables.reg_temp_table';
        const USER_NEAR_BY_TABLE             = 'tables.user_near_by_table';
        const PERMISSION_TABLE               = 'tables.permissions_table';
        const USER_PERMISSION_TABLE          = 'tables.user_permissions_table';
        const USER_VERIFICATION_IMAGES_TABLE = 'tables.user_verification_images_table';
        const CONTACT_TABLE                  = 'tables.contact_table';
        const FRIEND_REQUEST_TABLE           = 'tables.friend_requests_table';
        const FRIENDS_TABLE                  = 'tables.friends_table';
        const NOTIFICATION_TABLE             = 'tables.notification_table';
        const STATUS_TABLE                   = 'tables.status_table';
        const COMMENTS_TABLE                 = 'tables.comments_table';
        const LIKES_TABLE                    = 'tables.likes_table';
        const MISSING_PETS_TABLE             = 'tables.missing_pets_table';
        const PRIVACY_SETTING_TABLE          = 'tables.privacy_setting_table';
        const REPORT_TABLE                   = 'tables.report_feed_table';
        const TOKENS_TABLE                   = 'tables.user_token_table';
        const REPORT_USERS_TABLE             = 'tables.report_users_table';
    }
