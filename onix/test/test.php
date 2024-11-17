<?php
$message = "سلام اونیکس چه خبر عزیز";
$searchPhrase = "چه خبر";

if (strpos($message, $searchPhrase) !== false) {
    echo "true";
} else {
    echo "false";
}
?>
