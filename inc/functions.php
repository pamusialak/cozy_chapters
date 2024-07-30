<?php
function isLoggedIn() {
    session_start();
    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
        return true;
    }
    return false;
}
