<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    echo "Session tidak ditemukan. Silakan login ulang.";
    exit;
}
?>


