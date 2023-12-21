<!DOCTYPE html>
<html>
<head>
  <title>Search Photos</title>
  <style>
    /* CSS styles for form and photo display */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      text-align: center;
      padding: 20px;
    }
    h1 {
      margin-bottom: 20px;
    }
    form {
      margin-bottom: 20px;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .photo {
      margin: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
      padding: 10px;
      border-radius: 5px;
      text-align: center;
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
  <h1>Search Photos</h1>
  <?php
  $servername = "localhost";
  $username = "asipahi";
  $password = "zwZDxIcw";
  $database = "asipahi";

  $connect = mysqli_connect($servername, $username, $password, $database);

  if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }

 
  $locationQuery = "SELECT DISTINCT location FROM Photographh";
  $locationResult = mysqli_query($connect, $locationQuery);


  $yearQuery = "SELECT DISTINCT YEAR(date_taken) AS year FROM Photographh";
  $yearResult = mysqli_query($connect, $yearQuery);

  echo "<form method='post'>";
  echo "<label for='location'>Select Location:</label>";
  echo "<select name='location'>";
  echo "<option value=''>All Locations</option>";
  while ($row = mysqli_fetch_assoc($locationResult)) {
    echo "<option value='{$row['location']}'>{$row['location']}</option>";
  }
  echo "</select><br><br>";

  echo "<label for='year'>Select Year:</label>";
  echo "<select name='year'>";
  echo "<option value=''>All Years</option>";
  while ($row = mysqli_fetch_assoc($yearResult)) {
    echo "<option value='{$row['year']}'>{$row['year']}</option>";
  }
  echo "</select><br><br>";

  echo "<input type='submit' value='Search'>";
  echo "</form>";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locationFilter = $_POST['location'];
    $yearFilter = $_POST['year'];

    $sql = "SELECT * FROM Photographh WHERE 1=1";

    if (!empty($locationFilter)) {
      $sql .= " AND location = '{$locationFilter}'";
    }
    if (!empty($yearFilter)) {
      $sql .= " AND YEAR(date_taken) = '{$yearFilter}'";
    }

    $result = mysqli_query($connect, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
      echo "<div class='gallery'>";
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='photo'>";
        echo "<img src='{$row['image_url']}' alt='Photo'>";
        echo "<div class='caption'>Subject: {$row['subject']}<br>Location: {$row['location']}<br>Date Taken: {$row['date_taken']}</div>";
        echo "</div>";
      }
      echo "</div>";
    } else {
      echo "<p>No photos found for the selected criteria.</p>";
    }
  }

  mysqli_close($connect);
  ?>
</body>
</html>
