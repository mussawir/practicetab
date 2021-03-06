<?php

/*
 * @author Puneet Mehta
 * @website: http://www.PHPHive.info
 * @facebook: https://www.facebook.com/pages/PHPHive/1548210492057258
 */
 
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
ob_start();
session_start();

define('PROJECT_NAME', 'Post to your Facebook Wall/Timeline using PHP and Graph API  - www.PHPHive.info');

define('DB_DRIVER', 'mysql');
define('DB_SERVER', '14.102.148.43');
define('DB_SERVER_USERNAME', 'jobslane_practic');
define('DB_SERVER_PASSWORD', 'g@F[r_y3wu!N');
define('DB_DATABASE', 'jobslane_practice');

$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}

/* * ***** facebook related activities start ** */
//require './facebook_library/facebook.php';
require 'App\Models\facebook_library\facebook.php';

define("APP_ID", "1156660211085328");
define("APP_SECRET", "c4d0c3cccce065cec004ecd7cb25dd9b");
define("fileUpload", true);
/* make sure the url end with a trailing slash */
$actual_link = "http://$_SERVER[HTTP_HOST]";
define("SITE_URL", $actual_link.'/practicetab/practitioner/social-post/');
/* the page where you will be redirected after login */
define("REDIRECT_URL", SITE_URL."fblogin");
//define("REDIRECT_URL", SITE_URL);
/* Email permission for fetching emails. */
define("PERMISSIONS", "email,public_profile,user_friends,publish_actions");


/*  If database connection is OK, then proceed with facebook * */
// create a facebook object
$facebook = new Facebook(array('appId' => APP_ID, 'secret' => APP_SECRET));
$userID = $facebook->getUser();

// Login or logout url will be needed depending on current user login state.
if ($userID) {
  $logoutURL = $facebook->getLogoutUrl(array('next' => SITE_URL . 'logoutFb'));
} else {
  $loginURL = $facebook->getLoginUrl(array('scope' => PERMISSIONS, 'redirect_uri' => REDIRECT_URL));
}

function getuser()
{
    $facebook = new Facebook(array('appId' => APP_ID, 'secret' => APP_SECRET));
    return $facebook->getUser();
}
?>