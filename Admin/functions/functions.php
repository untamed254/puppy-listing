<?php
function is_logged_in() {
    // Check if the user has a session.
    if (!isset($_SESSION['admin_name'])) {
        return false;
    }

    // Check if the user has a session cookie.
    if (!isset($_COOKIE['session_id'])) {
        return false;
    }

    // If the user has both a session and a session cookie, they are logged in.
    return true;
}
//logout fxn
function logout_user() {
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(), '', 0, '/');
    session_regenerate_id(true);
}
?>