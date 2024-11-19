<?php
session_start(); // Start session at the beginning
include("connect.php");
$error_message = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind for checking existing username
    $stmt_check = $conn->prepare("SELECT COUNT(*) FROM data WHERE USERNAME = ?");
    $stmt_check->bind_param("s", $username);

    // Set parameters and execute
    $username = $_POST['username'];
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        $error_message = "Error: Username already exists."; // Set error message
    } else {
        // Prepare and bind for inserting new record
        $stmt = $conn->prepare("INSERT INTO data (NAME, USERNAME, EMAIL, NUMBER, ADDRESS) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $username, $email, $phone, $address);

        // Set parameters and execute
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if ($stmt->execute()) {
            $_SESSION['success'] = true; // Set success session variable
        } else {
            echo "Error: " . $stmt->error; // Show error if insert fails
        }

        $stmt->close();
    }
}
$conn->close();

// Check if the success session variable is set and show alert
if (isset($_SESSION['success'])) {
    echo "<script>
            alert('You have successfully registered!');
            window.location.href = 'index.php'; // Redirect to index.php
          </script>"; // Show pop-up alert and redirect
    unset($_SESSION['success']); // Clear the session variable after displaying the alert
}
?>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="image-section"></div>
        <div class="form-section">
            <h2>REGISTRATION FORM</h2>
            <form method="POST" action="">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <?php if ($error_message): ?>
                        <div style="color: red; margin-bottom: 5px;"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="fas fa-user"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="phone" placeholder="Contact Number" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <select name="gender" required>
                        <option value="">Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="form-group">
                    <input type="text" name="address" placeholder="Address" required>
                    <i class="fas fa-lock"></i>
                </div>
                <div class="form-group">
                    <button type="submit">Register <i class="fas fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>