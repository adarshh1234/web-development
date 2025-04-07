<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config
$host = "localhost";
$user = "root";
$password = "";
$dbname = "library";

// Connect to database
$conn = new mysqli($host, $user, $password, $dbname, 3307);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Book Insertion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $accno = $_POST["accno"];
    $title = $_POST["title"];
    $authors = $_POST["authors"];
    $edition = $_POST["edition"];
    $publisher = $_POST["publisher"];

    $stmt = $conn->prepare("INSERT INTO books (accession_number, title, authors, edition, publisher) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $accno, $title, $authors, $edition, $publisher);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?added=1");
        exit;
    } else {
        $errorMsg = "❌ Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Search
$searchResults = "";
if (isset($_GET["search"])) {
    $searchTitle = $_GET["search_title"];

    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
    $likeTitle = "%" . $searchTitle . "%";
    $stmt->bind_param("s", $likeTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $searchResults .= "<h3>Search Results:</h3>";
        $searchResults .= "<table>
            <tr>
                <th>Accession Number</th>
                <th>Title</th>
                <th>Authors</th>
                <th>Edition</th>
                <th>Publisher</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            $searchResults .= "<tr>
                <td>" . htmlspecialchars($row['accession_number']) . "</td>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . htmlspecialchars($row['authors']) . "</td>
                <td>" . htmlspecialchars($row['edition']) . "</td>
                <td>" . htmlspecialchars($row['publisher']) . "</td>
            </tr>";
        }
        $searchResults .= "</table>";
    } else {
        $searchResults .= "<p>🔍 No books found with that title.</p>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('library.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            position: relative;
        }

        /* Dark overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 50px 20px;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .container {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            max-width: 600px;
            width: 100%;
            color: #fff;
            margin-bottom: 40px;
        }

        h2, h3 {
            text-align: center;
            margin-top: 0;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 4px;
            margin-bottom: 12px;
            border: none;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 12px 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0b7dda;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255,255,255,0.1);
            color: #fff;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: rgba(0,0,0,0.4);
        }

        .message {
            color: #00ff99;
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: #ff6666;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <div class="container">
            <h2>Add Book Information</h2>

            <?php if (isset($_GET['added'])): ?>
                <p class="message">✅ Book added successfully!</p>
            <?php endif; ?>

            <?php if (isset($errorMsg)): ?>
                <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
            <?php endif; ?>

            <form method="post" action="">
                <label>Accession Number:</label>
                <input type="number" name="accno" required>

                <label>Title:</label>
                <input type="text" name="title" required>

                <label>Authors:</label>
                <input type="text" name="authors" required>

                <label>Edition:</label>
                <input type="text" name="edition" required>

                <label>Publisher:</label>
                <input type="text" name="publisher" required>

                <input type="submit" name="add" value="Add Book">
            </form>
        </div>

        <div class="container">
            <h2>Search Book by Title</h2>
            <form method="get" action="">
                <label>Enter Title:</label>
                <input type="text" name="search_title" required>
                <input type="submit" name="search" value="Search">
            </form>

            <div>
                <?= $searchResults ?>
            </div>
        </div>

    </div>
</body>
</html>
