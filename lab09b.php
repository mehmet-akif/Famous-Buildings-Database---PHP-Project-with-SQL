<!DOCTYPE html>
<html>
<head>
  <title>Photograph Information</title>
  <style>
    /* CSS styles to make information readable and attention-grabbing */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 20px;
    }
    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      background-color: #fff;
    }
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    tr:hover {
      background-color: #f9f9f9;
    }
  </style>
</head>
<body>
  <h1>Photograph Information</h1>
  <table>
    <thead>
      <tr>
        <th>Picture Number</th>
        <th>Subject</th>
        <th>Location</th>
        <th>Date Taken</th>
        <th>picture url</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $servername = "localhost";
      $username = "asipahi";
      $password = "zwZDxIcw";
      $database = "asipahi";

      $connect = mysqli_connect($servername, $username, $password, $database);

      if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
      }

      $sql = "SELECT * FROM Photographh ORDER BY date_taken DESC";
      $result = mysqli_query($connect, $sql);

      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>{$row['picture_number']}</td>";
          echo "<td>{$row['subject']}</td>";
          echo "<td>{$row['location']}</td>";
          echo "<td>{$row['date_taken']}</td>";
          // Assuming you have a field for Picture URL, replace 'picture_url' with your actual field name
          echo "<td>{$row['image_url']}</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='5'>No records found</td></tr>";
      }

      mysqli_close($connect);
      ?>
    </tbody>
  </table>
</body>
</html>
