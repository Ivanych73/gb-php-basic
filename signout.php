<?php
    setcookie("isAuthorized", false, time() - 3600);
    setcookie("isCustomer", false, time() - 3600);
    setcookie("isAdmin", false, time() - 3600);
    setcookie("userId", false, time() - 3600);
    setcookie("userLogin", false, time() - 3600);
    header("Location: {$_SERVER['HTTP_REFERER']}");
?>