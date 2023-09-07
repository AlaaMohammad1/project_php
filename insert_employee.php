<?php
include_once "sql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["insert"])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    try {
        $query = "INSERT INTO employee (name, gender, phone) VALUES (:name, :gender, :phone)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

    
        header("Location: View.php");
        exit();
    } catch (PDOException $e) {
        echo " errrrrrror";
        //header("Location: employee_form.html?message=error");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Employee Data</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS stylesheet -->
</head>
<style>
    /* CSS styles for the Insert Employee Data form */

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Form container styles */
.container {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

/* Heading styles */
h1 {
    font-size: 24px;
    margin-bottom: 20px;
}

/* Label styles */
label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

/* Input and select styles */
input[type="text"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
}

/* Submit button styles */
input[type="submit"] {
    background-color: #007BFF;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    display: block;
    margin: 0 auto;
}

/* Submit button hover styles */
input[type="submit"]:hover {
    background-color: #0056b3;
}

</style>
<body>
    <div class="container">
        <h1>Insert Employee Data</h1>
        <form method="post" action="insert_employee.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" name="phone" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Insert" name="insert">
            </div>
        </form>
    </div>
</body>
</html>



