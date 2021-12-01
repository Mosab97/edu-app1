<?php
//define("PUBLIC_DIR", 'public'); // this for server
define("PUBLIC_DIR", '');//this for local


define("ADMIN_PER_PAGE", 10);
define("API_PER_PAGE", 10);
define("ADMIN_LANG_DEFAULT", 'en');
define('DIR_UPLOAD', 'uploads');


//WEB site
define('WEBSITE', 'WebSite');
define('SITE_VIEWS_DIR', 'site');
define('SITE_PUBLIC_DIR', 'web');
define("SITE_ROUTE", 'site');


define("DEFAULT_IMAGE", 'no_image.png');


/*
 * System
 */
define('DATE_FORMAT', 'Y-m-d');
define('DATE_FORMAT_FULL', 'Y-m-d H:i:s');
define('TIME_FORMAT', 'H:i:s');
define('DATE_FORMAT_DOTTED', 'd.m.Y');


define('TIME_FORMAT_WITHOUT_SECONDS', 'h:i');


define('ROOT_NAMESPACE', 'Api\v1');
define('PASSWORD', '123456');


define("DEFAULT_category_IMAGE", 'category_image.png');
define("DEFAULT_item_IMAGE", 'item_image.png');

//Errors
define('IS_ERROR', 'isError');
define('ERRORS', 'errors');
define('ERROR', 'error');


//boolean
define('YES', 1);
define('NO', 0);


//Gender
define('Gender', [
    'MALE' => 1,
    'FEMALE' => 2,
]);


/***
 * API access token name
 */
define('API_ACCESS_TOKEN_NAME', 'Edu_App');


/*
 *
 * client numbers
 */
define('STUDENT_DEFAULT_PHONE', '+966500000000');
define('TEACHER_DEFAULT_PHONE', '+966500000001');
define('CODE_FIXED', '1234');


/*
* Notification types
* 1- Merchant
*/
define('CONTACT_US_NOTIFICATION', 1);
define('GENERAL_NOTIFICATION', 2);
define('CLOSE_CHAT_NOTIFICATION', 3);
define('NEW_CHAT_MESSAGE', 4);


/*
 * Permissions
 */

define('MANAGER_PERMISSIONS', [
    'General Settings',
    'Cities',
    'Banks',
    'Notification',
    'Join Us',
    'Users',
    'Ads',
    'Categories',
    'StakeHolders',
    'Contact Us',
    'Managers',
    'Roles',
    'Packages',
    'Nationality',
    'Faq',
    'Services',
    'Orders',
    'Customer Reviews',
    'Blogs',
    'Package Values',
    'Orders',
    'Advantages',
    'Statistics',
    'Special Services',
]);


//DIGIT_NUMBER for number format
define('DECIMAL_DIGIT_NUMBER', 1);
define('DECIMAL_SEPARATOR', '.');
define('DIGIT_THOUSANDS_SEPARATOR', '');


/***ERRORS_STATUS_CODE**/
define('METHOD_NOT_ALLOWED_EXCEPTION', 403);
define('UN_AUTHENTICATED', 401);
define('VALIDATION_EXCEPTION', 422);
define('SERVER_ERROR', 500);
define('UPDATE_APP_VERSION', 4000);
define('STOP_MOBILE_APP', 4001);
define('WAITING', 4003);


define('API_ACCESS_KEY', "AAAAsui00A0:APA91bEPVqiAdadlMPGKfnB3E5dqhQAGb26z6VZzaEjdsCf4smz39EPUkNPi0hOfAbYCngnpvN_ZrF7RhkxUAg7DGcpHLE7QdOIFnq39DAdLePzhC8Bz28T6kCtCTbKjrBMy1SJ135Cg");




define('file_type_aux', [
    'video' => 'data:video/mp4'
]);
