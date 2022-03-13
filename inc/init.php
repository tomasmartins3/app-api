<?php

if ( ! file_exists( __DIR__ . '/config.php' ) ) {
	die( "ERROR: config.php file doesn't exist" );
}

ini_set('file_uploads', 'On');

session_start();

require('config.php');

setlocale( LC_TIME, SITE_LANG );
date_default_timezone_set( SITE_TIMEZONE );

require( 'class-db.php' );
require( 'class-element.php' );
require( 'helpers.php' );

$app_db = new DB( DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE );

if ( isset( $_GET['logout'] ) ) {
	logout();
}
