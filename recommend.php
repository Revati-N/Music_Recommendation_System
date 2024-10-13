<?php
include 'get_token.php';

// Get user preferences from form
$mood = $_POST['mood'];
$genre = $_POST['genre'];
$language = $_POST['language'];

// Set default market and language-related seeds
$market = ''; 
$seed_artists = ''; 
$seed_genres = $genre; 

// Language-specific configurations
switch($language) {
    case 'english':
        $market = 'US';
        break;
    case 'hindi':
        $market = 'IN';
        $seed_genres = 'bollywood';
        break;
    case 'spanish':
        $market = 'ES';
        $seed_genres = 'latin';
        break;
    case 'korean':
        $market = 'KR';
        $seed_genres = 'k-pop';
        break;
    default:
        $market = 'US';
}

// Build the Spotify API URL
$api_url = "https://api.spotify.com/v1/recommendations?seed_genres=$seed_genres&market=$market";

if (!empty($seed_artists)) {
    $api_url .= "&seed_artists=$seed_artists";
}

// Fetch recommendations
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $token
));

$response = curl_exec($ch);
curl_close($ch);

$songs = json_decode($response, true)['tracks'];

// UI Design starts here
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Recommendations</title>
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
            font-size: 2.2em;
            color: #4a90e2;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .song-list {
            list-style: none;
            padding: 0;
        }
        .song-item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .song-item:last-child {
            border-bottom: none;
        }
        .song-title {
            font-size: 1.2em;
            color: #333;
        }
        .artist {
            color: #777;
            font-size: 0.9em;
        }
        .song-link {
            color: #4a90e2;
            text-decoration: none;
            font-size: 1em;
            display: inline-block;
            margin-top: 5px;
        }
        .song-link:hover {
            text-decoration: underline;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #357abd;
        }
    </style>
</head>
<body>

    <h2>Recommended Songs in <?php echo ucfirst($language); ?> for Mood: <?php echo ucfirst($mood); ?></h2>

    <div class="container">
        <ul class="song-list">
            <?php if (count($songs) > 0): ?>
                <?php foreach ($songs as $song): ?>
                    <li class="song-item">
                        <div class="song-title"><?php echo $song['name']; ?></div>
                        <div class="artist">by <?php echo $song['artists'][0]['name']; ?></div>
                        <a href="<?php echo $song['external_urls']['spotify']; ?>" class="song-link" target="_blank">Listen on Spotify</a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No recommendations found for the selected options.</li>
            <?php endif; ?>
        </ul>
        <button onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>

</body>
</html>
