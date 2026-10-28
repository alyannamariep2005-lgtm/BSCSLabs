<?php
session_start();
include('db.php');


if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}


$errors = [];
$success = "";


$username = $_SESSION['username'];
$result = pg_query_params($conn, 'SELECT * FROM users WHERE username = $1', [$username]);
$user = pg_fetch_assoc($result);


if (!$user) {
    session_destroy();
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $address = trim($_POST['address']);
    $cellphone = trim($_POST['cellphone']);
    $gender = trim($_POST['gender']);


    if (empty($address)) {
        $errors[] = "Address is required.";
    }


    if (empty($cellphone)) {
        $errors[] = "Cellphone number is required.";
    } elseif (!ctype_digit($cellphone)) {
        $errors[] = "Cellphone number must contain only numbers (no letters or symbols).";
    } elseif (strlen($cellphone) !== 11) {
        $errors[] = "Cellphone number must be exactly 11 digits.";
    }


    $allowed_genders = ['Male', 'Female'];
    if (empty($gender) || !in_array($gender, $allowed_genders)) {
        $errors[] = "Please select a valid gender.";
    }


  if (empty($errors)) {
    $update = pg_query_params(
        $conn,
        'UPDATE public.users
         SET address = $1, cellphone = $2, gender = $3
         WHERE username = $4',
        [$address, $cellphone, $gender, $username]
    );

    if ($update && pg_affected_rows($update) > 0) {
        $success = "Profile updated successfully!";

        $result = pg_query_params(
            $conn,
            'SELECT * FROM public.users WHERE username = $1',
            [$username]
        );

        $user = pg_fetch_assoc($result);
    } elseif ($update) {
        // The query worked, but no row was changed.
        $success = "No profile changes were made.";
    } else {
        $errors[] = "Database error: " . pg_last_error($conn);
    }
}

}
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>


<body>
    <h3>Edit Profile</h3>
    <form method="POST">
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($user['address'] ?? ''); ?>">
        <br><br>


        <label for="cellphone">Cellphone Number (11 digits):</label>
        <input type="text" name="cellphone" maxlength="11" value="<?php echo htmlspecialchars($user['cellphone'] ?? ''); ?>">
        <br><br>


        <label for="gender">Gender:</label>
        <select name="gender" id="gender">
            <option value="">--Select Gender--</option>
            <option value="Male" <?php echo (isset($user['gender']) && $user['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo (isset($user['gender']) && $user['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
        </select>
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
        <br><br>


        <button type="submit">Update</button>
    </form>
    <br><br>
   
    <strong>Saved Information:</strong><br>
    <?php
        echo "Address: " . htmlspecialchars($user['address'] ?? '') . "<br>";
        echo "Cellphone: " . htmlspecialchars($user['cellphone'] ?? '') . "<br>";
        echo "Gender: " . htmlspecialchars($user['gender'] ?? '') . "<br>";
    ?>
    <a href="dashboard.php">Delete</a>
    <br><br>
    <a href="dashboard.php">Back to Dashboard</a>
    <br><br>


    <?php
    if ($success) {
        echo "<div style='color:green; font-weight:bold;'>" . $success . "</div>";
    }


    if (!empty($errors)) {
        echo "<div style='color:red;'>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
        echo "</div>";
    }
    ?>
</body>


</html>



