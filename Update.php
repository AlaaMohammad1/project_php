<?php 
include_once "sql.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    
    $employee_id = $_POST['employee_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];

    try {
        $query = "UPDATE employee SET name = :name, gender = :gender, phone = :phone WHERE id = :employee_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
    
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
       
       echo "error";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee Data</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <style> 
   
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


.container {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 300px;
}

h1 {
    font-size: 24px;
    margin-bottom: 20px;
}


label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}


input[type="text"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 10px;
}

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

input[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
    <div class="container">
        <h1>Update Employee Data</h1>
        <form method="post" action="Update.php">
            <div class="form-group">
                <label for="employee_id">Employee ID:</label>
                <input type="text" name="employee_id" required>
            </div>
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
                <input type="submit" value="Update" name="update">
            </div>
        </form>
    </div>
</body>
</html>
