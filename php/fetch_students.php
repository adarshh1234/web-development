<?php
$servername = "127.0.0.1"; // Change if needed
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password (leave empty for XAMPP)
$database = "school_db"; // Your database name

// Create connection (change port if needed)
$conn = new mysqli($servername, $username, $password, $database, 3307);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from students table
$sql = "SELECT id, name, age, grade FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f5f5f5;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #d1ecf1;
            cursor: pointer;
        }

        td {
            border-bottom: 1px solid #ddd;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
            }
            th, td {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <h2>Student Details</h2>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Grade</th></tr>";
        
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['grade']}</td>
                  </tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No records found.</p>";
    }

    // Close the connection
    $conn->close();
    ?>

</body>
</html>
