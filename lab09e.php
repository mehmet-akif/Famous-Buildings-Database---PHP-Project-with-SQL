<!DOCTYPE html>
<html>
<head>
  <title>Random Image</title>
  <style>
    /* CSS styles for displaying the random image */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      text-align: center;
      padding: 20px;
    }
    h1 {
      margin-bottom: 20px;
    }
    .photo {
      margin: 20px auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      padding: 10px;
      border-radius: 5px;
      display: inline-block;
    }
    .photo img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
    }
    .caption {
      margin-top: 10px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Random Image</h1>

  <?php
  $servername = "localhost";
  $username = "asipahi";
  $password = "zwZDxIcw";
  $database = "asipahi";

  $connect = mysqli_connect($servername, $username, $password, $database);

  if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Query to get total number of images
  $totalImagesQuery = "SELECT COUNT(*) AS total_images FROM Photographh";
  $totalImagesResult = mysqli_query($connect, $totalImagesQuery);
  $totalImagesRow = mysqli_fetch_assoc($totalImagesResult);
  $totalImages = $totalImagesRow['total_images'];

  // Query to select one random image
  $randomImageQuery = "SELECT * FROM Photographh ORDER BY RAND() LIMIT 1";
  $randomImageResult = mysqli_query($connect, $randomImageQuery);

  if ($randomImageResult && mysqli_num_rows($randomImageResult) > 0) {
    $randomImage = mysqli_fetch_assoc($randomImageResult);

    echo "<div class='photo'>";
    echo "<img src='{$randomImage['image_url']}' alt='Random Photo'>";
    echo "<div class='caption'>Subject: {$randomImage['subject']}<br>Location: {$randomImage['location']}<br>Date Taken: {$randomImage['date_taken']}</div>";
    echo "</div>";

    echo "<p>Total number of images in the database: {$totalImages}</p>";
  } else {
    echo "<p>No images found in the database.</p>";
  }

  mysqli_close($connect);
  ?>
</body>
</html>

