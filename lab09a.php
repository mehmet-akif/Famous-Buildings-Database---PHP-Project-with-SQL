<?php
$servername = "localhost"; 
$username = "asipahi"; 
$password = "zwZDxIcw"; 
$database = "asipahi";

$connect = mysqli_connect($servername, $username, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());

}

$clearTable = mysqli_query($connect, "DELETE FROM Photographh");
if ($clearTable) {
        echo "table cleared<br>";
    } else {
        echo "Error clearing table: " . mysqli_error($connect) . "<br>";
}

$sql = "CREATE TABLE IF NOT EXISTS Photographh (
    picture_number INT PRIMARY KEY,
    subject VARCHAR(100),
    location VARCHAR(100),
    date_taken DATE,
    image_url VARCHAR(500)
)";

if (mysqli_query($connect, $sql)) {
    echo "Table 'Photograph' created or already exists.<br>";
} else {
    echo "Error creating table: " . mysqli_error($connect) . "<br>";
}

$records = [
    [1, 'Galata Tower', 'Istanbul, Turkey', '2020-11-01', 'https://i.imgur.com/fDrHxuD.jpeg'],
    [2, 'Eiffel Tower', 'Paris, France', '2019-12-15', 'https://i.imgur.com/Wa8QwRJ.jpeg'],
    [3, 'Statue of Liberty', 'New York, USA', '2022-11-05', 'https://i.imgur.com/FQnQCSH_d.webp?maxwidth=1520&fidelity=grand'],
    [4, 'Big Ben Tower', 'London, UK', '2018-10-19', 'https://i.imgur.com/wq4QBdK.jpeg'],
    [5, 'The Colosseum', 'Rome, Italy', '2023-11-01', 'https://i.imgur.com/WRIg7KI.jpeg'],
    [6, 'Taj Mahal', 'Agra, India', '2023-11-01', 'https://i.imgur.com/qPETfU1.jpeg'],
    [7, 'Great Wall of China', 'Beijing, China', '2023-11-01', 'https://i.imgur.com/uOls08Z.jpeg'],
    [8, 'Sydney Opera House', 'Sydney, Australia', '2023-11-01', 'https://i.imgur.com/lkQIL5j.jpeg'],
    [9, 'Christ the Redeemer Statue', 'Rio de Janeiro, Brazil', '2023-11-01', 'https://i.imgur.com/ehMsC.jpeg'],
    [10, 'Pisa Tower', 'Pisa, Italy', '2023-05-20', 'https://i.imgur.com/JdcUUde.jpeg']
];

foreach ($records as $record) {
    $insertSql = "INSERT INTO Photographh (picture_number, subject, location, date_taken, image_url) VALUES ('{$record[0]}', '{$record[1]}', '{$record[2]}', '{$record[3]}', '{$record[4]}')";

    if (mysqli_query($connect, $insertSql)) {
        echo "Record inserted successfully.<br>";
    } else {
        echo "Error inserting record: " . mysqli_error($connect) . "<br>";
    }
}

mysqli_close($connect);
?>
