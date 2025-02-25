<?php
define('ADMIN_LOGIN', 'wally');
define('ADMIN_PASSWORD', 'mypass');

session_start();

if (!isset($_SESSION['logged_in'])) {
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
        $_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN || $_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD) {
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Our Blog"');
        exit("Access Denied: Username and password required.");
    } else {
        $_SESSION['logged_in'] = true;
    }
}
?>
