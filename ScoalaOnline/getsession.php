<?php
session_start();
if (isset($_GET['username'])) {
    // return requested value
    print $_SESSION[$_GET['username']];
} else {
    // nothing requested, so return all values
    print json_encode($_SESSION);
}