<?php
session_start();
$_SESSION['name'] = "Asmita";
echo $_SESSION['name'];
?>

<html>
    <body>
        <?php
        $_SESSION['name'] = "Asmita";
        $_SESSION['class'] = "BCA";

        echo "Session Variables are set";
        ?>
    </body>
</html>