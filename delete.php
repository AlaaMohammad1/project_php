<?php
include_once "sql.php";


$query = "SELECT * FROM employee";
$stmt = $pdo->query($query);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
   
    $employee_id = $_POST["employee_id"];

    try {
       
        $query = "DELETE FROM employee WHERE id = :employee_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();

       
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    
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
    width: 80%;
    margin: 0 auto;
}


h1 {
    font-size: 24px;
    margin-bottom: 20px;
}


form {
    margin-top: 20px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table th {
    background-color: #007BFF;
    color: white;
    padding: 10px;
    text-align: left;
}

table td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

button[name="delete"] {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 5px 10px;
    border-radius: 3px;
    cursor: pointer;
    
}

button[name="delete"]:hover {
    background-color: #c82333;
}

    </style>
    <div class="container">
        <h1>Employee Management</h1>

       
        <form method="post" action="insert_employee.php">
            
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['gender']; ?></td>
                        <td><?php echo $employee['phone']; ?></td>
                        <td>
                            <form method="post" action="delete.php">
                                <input type="hidden" name="employee_id" value="<?php echo $employee['id']; ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
