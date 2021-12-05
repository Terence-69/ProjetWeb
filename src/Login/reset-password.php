<?php
session_start();

require_once '../../bootstrap.php';

use Meteo\Mysql;

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if (empty(trim($_POST["new_password"]))) {
    $new_password_err = "Please enter the new password.";
} elseif (strlen(trim($_POST["new_password"])) < 6) {
    $new_password_err = "Password must have atleast 6 characters.";
} else {
    $new_password = trim($_POST["new_password"]);
}

if (empty($new_password_err)) {

    $param_id = $_SESSION["id"];
    $param_password = password_hash($new_password, PASSWORD_DEFAULT);

    $mysqli = Mysql::getInstance();

    $query = 'UPDATE users SET pwd = "' . $param_password . '" WHERE id = ' . $param_id . ';';

    $result = $mysqli->query($query);

    if (!$result) {
        echo "Oops! Something went wrong. Please try again later.";
    } else {
        session_destroy();
        header("location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>