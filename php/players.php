<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>India 2024 T20 World Cup Winning XI</title>
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
            background: url('INDIA.jpg') no-repeat center center/cover;
            background-attachment: fixed;
            font-family: 'Poppins', sans-serif;
        }

        #main {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 550px;
            text-align: center;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        h1 {
            font-weight: 700;
            font-family: 'Verdana', sans-serif;
            text-align: center;
            margin-bottom: 20px;
            color: #FFD700;
            text-shadow: 2px 2px 15px rgba(0, 0, 0, 0.6);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            backdrop-filter: blur(5px);
            color: white;
        }

        th {
            background-color: rgba(0, 123, 255, 0.7);
            padding: 15px;
            font-size: 18px;
            text-align: center;
        }

        td {
            padding: 12px;
            font-size: 16px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        tr:nth-child(even) {
            background-color: rgba(255, 255, 255, 0.1);
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
            cursor: pointer;
            font-weight: bold;
        }

        button {
            margin-top: 30px;
            padding: 12px 24px;
            border: none;
            background: linear-gradient(45deg, #FF5733, #C70039);
            color: white;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(45deg, #C70039, #FF5733);
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div id="main">
        <h1>India 2024 T20 World Cup Winning XI</h1>

        <table>
            <tr>
                <th>#</th>
                <th>Player Name</th>
            </tr>
            <?php
            // India 2024 T20 WC Winning XI (Example Players)
            $players = array(
                "Rohit Sharma (C)", "Shubman Gill", "Virat Kohli", "Suryakumar Yadav",
                "Rishabh Pant (WK)", "Hardik Pandya", "Ravindra Jadeja", "Axar Patel",
                "Jasprit Bumrah", "Mohammed Siraj", "Yuzvendra Chahal"
            );

            // Display players in a table
            $index = 1;
            foreach ($players as $player) {
                echo "<tr>
                        <td>$index</td>
                        <td>$player</td>
                      </tr>";
                $index++;
            }
            ?>
        </table>

        <button onclick="alert('2024 T20 WC Winning XI Loaded Successfully!')">Click Me</button>
    </div>

</body>
</html>
