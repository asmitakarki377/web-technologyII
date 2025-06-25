<?php
$numbers = [4, 5, 4, 5, 2, 2, 3, 3, 2, 4]; 
file_put_contents('numbers.txt', implode(' ', $numbers));
echo "numbers.txt created!\n";
