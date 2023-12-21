<!DOCTYPE html>
<html>
<head>
  <title>Ontario Photos</title>
  <style>
    /* CSS styles to make information attractive */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      text-align: center;
    }
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      grid-gap: 20px;
      margin: 20px;
    }
    .photo {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      padding: 10px;
      border-radius: 5px;
    }
    .photo img {
      width: 100%;
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
  <h1>Ontario Photos</h1>
  <div class="gallery">
    <?php
    $servername = "localhost";
    $username = "asipahi";
    $password = "zwZDxIcw";
    $database = "asipahi";

    $connect = mysqli_connect($servername, $username, $password, $database);

    if (!$connect) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM Photographh WHERE location LIKE '%Ontario%'";
    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='photo'>";
        echo "<img src='{$row['image_url']}' alt='Photo'>";
        echo "<div class='caption'>Subject: {$row['subject']}<br>Location: {$row['location']}</div>";
        echo "</div>";
      }
    } else {
      echo "<p>No Ontario photos found</p>";
    }

    mysqli_close($connect);
    ?>
  </div>
</body>
</html>

