<?php
/**
 * User: TheCodeholic
 * Date: 5/5/2019
 * Time: 7:56 PM
 */

function redirect($url)
{
    header("Location: $url");
}

function isLoggedIn()
{
    return isset($_SESSION['currentUser']);
}

function currentUser()
{
    return isset($_SESSION['currentUser']) ? $_SESSION['currentUser'] : null;
}
