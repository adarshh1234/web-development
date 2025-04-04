<?php
$username = $email = $password = $confirmPassword = "";
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$successMessage = ""; // Store success message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            $usernameErr = "Only letters and numbers are allowed";
        }
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (strlen($password) < 6) {
            $passwordErr = "Password must be at least 6 characters long";
        }
    }

    // Validate Confirm Password
    if (empty($_POST["confirmPassword"])) {
        $confirmPasswordErr = "Please confirm your password";
    } else {
        $confirmPassword = test_input($_POST["confirmPassword"]);
        if ($confirmPassword !== $password) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If no errors, proceed with form submission
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        $successMessage = "Registration successful!";
    }
}

// Function to sanitize input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: lightblue;
            font-family: sans-serif;
            flex-direction: column;
        }

        /* Popup Notification (Above the form) */
        .popup {
            display: none;
            position: fixed;
            top: 10%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            z-index: 1000;
            font-size: 18px;
            font-weight: bold;
            color: green;
            border: 2px solid green;
            animation: fadeIn 0.5s ease-in-out;
        }

        .popup button {
            margin-top: 10px;
            background-color: #007bff;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .popup button:hover {
            background-color: #0056b3;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                top: 0%;
            }
            to {
                opacity: 1;
                top: 10%;
            }
        }

        .form-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            margin-top: 50px; /* To give space for popup */
        }

        h2 {
            font-weight: 700;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 18px;
            font-weight: 500;
            font-family: sans-serif;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            border: none;
            background-color: rgb(255, 102, 0);
            color: white;
            font-size: 18px;
            font-weight: 500;
            font-family: sans-serif;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: rgb(230, 90, 0);
        }
    </style>
</head>
<body>

<!-- Popup Notification (Appears above the form) -->
<div id="popup" class="popup">
    <p id="popupMessage"></p>
    <button onclick="closePopup()">OK</button>
</div>

<!-- Registration Form -->
<div class="form-container">
    <h2>Registration Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return showPopup('<?php echo $successMessage; ?>')">
        <!-- Username -->
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo $usernameErr; ?></span>

        <!-- Email -->
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr; ?></span>

        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" name="password">
        <span class="error"><?php echo $passwordErr; ?></span>

        <!-- Confirm Password -->
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" name="confirmPassword">
        <span class="error"><?php echo $confirmPasswordErr; ?></span>

        <!-- Submit Button -->
        <button type="submit">Register</button>
    </form>
</div>

<script>
    function showPopup(message) {
        if (message) {
            document.getElementById('popupMessage').innerText = message;
            document.getElementById('popup').style.display = 'block';
            return false; // Prevent form from refreshing
        }
        return true; // Allow form submission if there's an error
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
        window.location.href = "<?php echo $_SERVER['PHP_SELF']; ?>"; // Refresh the page
    }
</script>

</body>
</html>
