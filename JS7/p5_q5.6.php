<?php
$pattern = '/go{2,4}d/'; // Matches "good" or "goood"
$text = 'god is good.';

if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok!";
}
?>