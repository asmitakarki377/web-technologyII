<?php
setcookie("Asmita", "Karki", time()+ 86400);
// print_r($_COOKIE);

if(!isset($_COOKIE["Asmita"])) {
    echo "Cookie 'Asmita' is set! <br>";
    echo "Value is: " . $_COOKIE["Asmita"];
}
else {
    echo "Cookie 'Asmita' is not set!";
}
?>