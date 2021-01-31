<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'database.php';
$db_connection = new DB();
$conn = $db_connection->dbConnect();

$data = json_decode(file_get_contents("php://input"));

if(isset($data->client_id)){
  $response = '';

  $client_id = $data->client_id;

  $statement = "SELECT * FROM client WHERE id=".$client_id.";";
  $sth = $conn->prepare($statement);
  $sth->execute();

  if($sth->rowCount() > 0)
  {
    $delete_statement = "DELETE FROM client WHERE id=".$client_id.";";
    $delete_sth = $conn->prepare($delete_statement);

    if($delete_sth->execute())
    {
      $response = 'The client was successfully deleted';
    }
    else
    {
      $response = 'Failed to delete client';
    }
  }
  else
  {
    $response = 'There are no clients matching that ID';
  }

  return  json_encode($response);
}
?>