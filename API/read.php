<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require 'database.php';
$db_connection = new DB();
$conn = $db_connection->dbConnect();

$response = "There are currently no clients in the database";

$statement = "SELECT * FROM client";
$sth = $conn->prepare($statement);
$sth->execute();

if($sth->rowCount() > 0)
{
  $clients = [];

  while($row = $sth->fetch(PDO::FETCH_ASSOC))
  {
    $client = [
      'client_id' => $row['client_id'],
      'client_name' => $row['client_name'],
      'client_age' => $row['client_age'],
      'email' => $row['email']
    ];

    array_push($clients, $client);
  }

  return json_encode($clients);

}
else
{
  return json_encode($response);
}
?>

