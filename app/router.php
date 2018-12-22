<?php
if (preg_match('/\.(?:png|css|js|php|txt)$/', $_SERVER["REQUEST_URI"])) {
    return false;
} else {
    include __DIR__ . '/index.php';
}
// php -S localhost:8888 router.php