<?php

setcookie('counter', 0, time() + 60 * 60 * 24 * 365 * 10);

$count = $_COOKIE['counter'];

$count++;

setcookie('counter', $count, time() + 60 * 60 * 24 * 365 * 10);

echo "Šitas puslapis buvo atidarytas $count kartus";
