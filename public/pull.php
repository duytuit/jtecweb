<?php
# Author: Yujin Boby
# Web: https://serverok.in/php-script-to-pull-changes-from-git-repository
# Email: admin@serverOk.in
# This script pull latest code from git.

$pw = isset($_GET["pw"]) ? $_GET["pw"] : '';

$type = isset($_GET["type"]) ? $_GET["type"] : '';

if ($pw != '123qwe4') {
    die("Invalid password");
}
if ($type == 1) { // kéo code
    $result = exec("git pull origin main 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }

    unset($r2);

    echo "\n\n";
    echo "------------------------------------------------------";
    echo "\ngit status\n";
    echo "------------------------------------------------------";
    echo "\n\n";

    $result = exec("git status 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
}

if ($type == 2) { // kéo code update migrate database
    $result = exec("git pull origin main 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }

    unset($r2);

    echo "\n\n";
    echo "------------------------------------------------------";
    echo "\ngit status\n";
    echo "------------------------------------------------------";
    echo "\n\n";

    $result = exec("git status 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }

    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan migrate", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
}
if ($type == 3) { // kéo code clear cache
    $result = exec("git pull origin main 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }

    unset($r2);

    echo "\n\n";
    echo "------------------------------------------------------";
    echo "\ngit status\n";
    echo "------------------------------------------------------";
    echo "\n\n";

    $result = exec("git status 2>&1", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan config:clear", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan config:cache", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan cache:clear", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }

    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan view:clear", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
    unset($r2);

    $result = exec("cd D:/dev_web/jtecweb/ && php artisan route:cache", $r2);

    echo "<pre>";

    foreach ($r2 as $line) {
        echo $line . "\n";
    }
}



