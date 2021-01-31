<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: PUT");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'database.php';
$db_connection = new DB();
$conn = $db_connection->dbConnect();

$data = json_decode(file_get_contents("php://input"));

if(isset($data->client_id))
{
  $response = '';
  $client_id = $data->client_id;

  $statement = "SELECT * FROM client WHERE client_id=".$client_id.";";
  $sth = $conn->prepare($statement);
  $sth->execute();

  if($sth->rowCount() > 0)
  {
    $row = $sth->fetch(PDO::FETCH_ASSOC);

    $client_id = $row['client_id'];
    $client_name = $row['client_name'];
    $client_age = $row['client_age'];
    $email = $row['email'];

    $update_statement = "UPDATE client SET client_name = ".$client_name.", client_age = ".$client_age.", email = ".$email." 
        WHERE client_id = ".$client_id.";";

    $update_sth = $conn->prepare($update_statement);

    if($update_sth->execute())
    {
      $response = 'Client updated successfully';
    }
    else
    {
      $response = 'Failed to update client';
    }
  }
  else
  {
    $response = 'There are no clients matching that ID';
  }

  return  json_encode($response);

}
?>