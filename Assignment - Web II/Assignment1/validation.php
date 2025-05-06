<?php
include 'database.php';

function is_alphabetic($str) {
    return preg_match('/^[a-zA-Z\s\-]+$/', $str);
}

function is_alphanumeric($str) {
    return preg_match('/^[a-zA-Z0-9\s\-]+$/', $str);
}

$errors = [];
$userid = $password = $firstname = $address = $zip = $email = $sex = $country = $about = "";
$lang = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = trim($_POST["userid"]);
    $password = trim($_POST["password"]);
    $firstname = trim($_POST["firstname"]);
    $address = trim($_POST["address"]);
    $zip = trim($_POST["zip"]);
    $email = trim($_POST["email"]);
    $country = $_POST["country"];
    $sex = isset($_POST["sex"]) ? $_POST["sex"] : "";
    $lang = isset($_POST["lang"]) ? $_POST["lang"] : [];
    $about = trim($_POST["about"]);

    // Validation
    if (strlen($userid) < 5 || strlen($userid) > 12)
        $errors[] = "User ID must be between 5 and 12 characters.";

    if (strlen($password) < 7 || strlen($password) > 12)
        $errors[] = "Password must be between 7 and 12 characters.";

    if (!is_alphabetic($firstname))
        $errors[] = "First name must contain only letters, spaces, or hyphens.";

    if (!empty($address) && !is_alphanumeric($address))
        $errors[] = "Address must be alphanumeric (letters, numbers, spaces, hyphens).";

    if (!ctype_digit($zip))
        $errors[] = "ZIP code must be numeric.";

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Email is not valid.";

    if (empty($sex))
        $errors[] = "Please select your sex.";

    if (empty($lang))
        $errors[] = "Please select at least one language.";

    // If valid, insert into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $lang_string = implode(", ", $lang); // Join multiple languages
    
        $stmt = $conn->prepare(
            "INSERT INTO registrationform (`Password`, `First Name`, `Address`, `Country`, `Zip Code`, `Email`, `Sex`, `Language`, `About`)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssssssss", $hashed_password, $firstname, $address, $country, $zip, $email, $sex, $lang_string, $about);
        $stmt->execute();
    
        echo "<h3>Registration Successful!</h3>";
        echo "<p>Welcome, <strong>" . htmlspecialchars($firstname) . "</strong>!</p>";
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <style>
        .error { color: red; font-size: 14px; }
        label { display: inline-block; width: 100px; }
    </style>
</head>
<body>
    <h2>Registration Form</h2>

    <?php
    if (!empty($errors)) {
        echo "<div class='error'><ul>";
        foreach ($errors as $err) {
            echo "<li>" . htmlspecialchars($err) . "</li>";
        }
        echo "</ul></div>";
    }
    ?>

    <form method="POST" action="">
        <label>User ID: *</label>
        <input type="text" name="userid" value="<?= htmlspecialchars($userid) ?>" required><br><br>

        <label>Password: *</label>
        <input type="password" name="password" required><br><br>

        <label>First Name: *</label>
        <input type="text" name="firstname" value="<?= htmlspecialchars($firstname) ?>" required><br><br>

        <label>Address:</label>
        <input type="text" name="address" value="<?= htmlspecialchars($address) ?>"><br><br>

        <label>Country: *</label>
        <select name="country" required>
            <option value="Nepal" <?= $country == "Nepal" ? "selected" : "" ?>>Nepal</option>
            <option value="India" <?= $country == "India" ? "selected" : "" ?>>India</option>
            <option value="USA" <?= $country == "USA" ? "selected" : "" ?>>USA</option>
        </select><br><br>

        <label>ZIP Code: *</label>
        <input type="text" name="zip" value="<?= htmlspecialchars($zip) ?>" required><br><br>

        <label>Email: *</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required><br><br>

        <label>Sex: *</label>
        <input type="radio" name="sex" value="Male" <?= $sex == "Male" ? "checked" : "" ?>> Male
        <input type="radio" name="sex" value="Female" <?= $sex == "Female" ? "checked" : "" ?>> Female<br><br>

        <label>Language: *</label>
        <input type="checkbox" name="lang[]" value="English" <?= in_array("English", $lang) ? "checked" : "" ?>>English
        <input type="checkbox" name="lang[]" value="Non English" <?= in_array("Non English", $lang) ? "checked" : "" ?>>Non English<br><br>

        <label>About:</label><br>
        <textarea name="about" rows="5" cols="40"><?= htmlspecialchars($about) ?></textarea><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
