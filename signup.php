<?php

session_start();

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if ($name == "" || $email == "" || $password == "") {

        $error = "All fields are required!";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Invalid Email Address!";

    } elseif (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } else {

        $users = [];

        if (file_exists("users.json")) {

            $users = json_decode(file_get_contents("users.json"), true);

            if (!is_array($users)) {

                $users = [];

            }

        }

        $emailExists = false;

        foreach ($users as $user) {

            if (strtolower($user["email"]) == strtolower($email)) {

                $emailExists = true;
                break;

            }

        }

        if ($emailExists) {

            $error = "Email already exists!";

        } else {

            $users[] = [

                "name" => htmlspecialchars($name),
                "email" => strtolower($email),
                "password" => password_hash($password, PASSWORD_DEFAULT)

            ];

            file_put_contents(
                "users.json",
                json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
            );

            $message = "Account created successfully! Please Sign In.";

        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Fashion Store - Sign Up</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="auth-container">

<div class="auth-card">

<h1>Create Fashion Store Account</h1>

<form method="POST">

<input
type="text"
name="name"
placeholder="Full Name"
required
>

<input
type="email"
name="email"
placeholder="Email Address"
required
>

<input
type="password"
name="password"
placeholder="Password"
required
>

<button type="submit">

Sign Up

</button>

</form>

<?php if($message!=""){ ?>

<div class="success-box">

<?php echo htmlspecialchars($message); ?>

</div>

<?php } ?>

<?php if($error!=""){ ?>

<div class="error-box">

<?php echo htmlspecialchars($error); ?>

</div>

<?php } ?>

<p>

Already have an account?

<a href="signin.php">

Sign In

</a>

</p>

</div>

</div>

</body>

</html>