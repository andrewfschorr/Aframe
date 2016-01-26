<?php
date_default_timezone_set('America/New_York');

if (ENV === 'dev') {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB', 'aframe');
    define('CODE', 'jakesbuddy');
} else {
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '132AllenSt!');
    define('DB', 'aframe');
    define('CODE', 'jakesbuddy');
}
