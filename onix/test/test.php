<?php

$tt = time() + 0.6;


if ($tt < $time()) {
    var_dump('error');
} else {
    var_dump($tt);
}
