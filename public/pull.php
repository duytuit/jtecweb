<?php

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
