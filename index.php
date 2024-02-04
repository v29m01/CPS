
<?php

//session_start();
include('config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $role = $_POST['role'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Perform role-based login
    switch ($role) {
        case 'student':
            $table = 'student_table';
            break;
        case 'company':
            $table = 'company_table';
            break;
        case 'admin':
            $table = 'admin_table';
            break;
        case 'superadmin':
            $table = 'superadmin_table';
            break;
        default:
            // Handle invalid role
            break;
    }

    // Fetch user from the specified table
    $query = $con->prepare("SELECT * FROM $table WHERE email = :email AND password = :password");
    $query->bindParam(':email', $email);
    $query->bindParam(':password', $password);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Successful login, store user information in session or redirect to respective page
        $_SESSION['user'] = $user;

        // Adjust redirection based on role
        switch ($role) {
            case 'student':
                header("Location: students/index.php");
                break;
            case 'company':
                header("Location: company/index.php");
                break;
            case 'admin':
                header("Location: user/index.php");
                break;
            case 'superadmin':
                header("Location: admin/index.php");
                break;
            default:
                header("Location: {$role}/index.php"); // Redirect to the respective role page
                break;
        }

        exit();
    } else {
        // Invalid login credentials
        $error_message = "Invalid credentials. Please try again.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDTC | Placement System</title>
     <!-- favicon -->
    <link rel="icon" type="image/png" href="dist/img/logo.png">
    <!-- CSS -->
    <link rel="stylesheet" href="dist/css/style.css">
</head>
<body>
    <div class="log-card">
        <div class="log1">
            <div class="log2">
            <a href="https://rajgad.edu.in/"><img src="images/login.png" alt="" srcset=""></a>   
                <form action="" class="form1" method="post">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email address">
                    <label for="password">Password:</label>
                    <input type="password" id="pass" name="password" placeholder="Enter your password">
                    <label for="role">Role</label>
                    <select name="role" id="role">
                        <option value="student">Student</option>
                        <option value="company">Company</option>
                        <option value="admin">HOD</option>
                        <option value="superadmin">Admin</option>
                    </select>
                    <input type="submit" value="Login" class="btn-submit">

                </form>
               
                <!-- login form end -->
            </div>
            <div class="log3">
                <img src="images/campus.jpg" alt="Campus Image" style="height:100vh;width:100%;object-fit:cover;">
            </div>
        </div>
    </div>

</body>
</html>
