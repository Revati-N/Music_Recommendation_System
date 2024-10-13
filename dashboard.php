<?php
if (!isset($_COOKIE['user'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Dashboard</title>
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 20px;
            font-size: 2em;
            color: #4a90e2;
        }
        form {
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        select, button {
            width: 85%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }
        button {
            background-color: #4a90e2;
            color: white;
            cursor: pointer;
            font-size: 16px;
            border: none;
        }
        button:hover {
            background-color: #357abd;
        }
        label {
            font-size: 1.2em;
            margin-bottom: 5px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_COOKIE['user']; ?></h2>

    <form action="recommend.php" method="post">
        <!-- Mood Options -->
        <label for="mood">Choose Mood:</label>
        <select name="mood" id="mood">
            <option value="happy">Happy</option>
            <option value="sad">Sad</option>
            <option value="energetic">Energetic</option>
            <option value="bored">Bored</option>
            <option value="angry">Angry</option>
        </select><br>

        <!-- Genre Options -->
        <label for="genre">Choose Genre:</label>
        <select name="genre" id="genre">
            <option value="pop">Pop</option>
            <option value="rock">Rock</option>
            <option value="jazz">Jazz</option>
            <option value="classical">Classical</option>
            <option value="hip-hop">Hip-Hop</option>
        </select><br>

        <!-- Language Options -->
        <label for="language">Choose Language:</label>
        <select name="language" id="language">
            <option value="english">English</option>
            <option value="hindi">Hindi</option>
            <option value="spanish">Spanish</option>
            <option value="korean">Korean</option>
        </select><br>

        <!-- Submit Button -->
        <button type="submit">Get Recommendations</button>
    </form>
</body>
</html>
