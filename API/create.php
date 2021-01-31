<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'database.php';
$db_connection = new DB();
$conn = $db_connection->dbConnect();

$data = json_decode(file_get_contents("php://input"));

$response = "";

if(isset($data->client_id) && isset($data->client_name) && isset($data->client_age) && isset($data->email))
{
  if($data->client_id != "" && $data->client_name != "" && $data->client_age != "" && $data->email != "")
  {
    $statement = "INSERT INTO client (client_id,client_name,client_age,email) VALUES(".$data->client_id.",".$data->client_name.",".$data->client_age.",".$data->email.")";
    $sth = $conn->prepare($statement);

    if($sth->execute())
    {
      $response = 'Data Inserted Successfully';
    }
    else
    {
      $response = 'Failed to insert the record';
    }
  }
  else
  {
    $response = 'Please ensure no fields are empty';
  }

}
else
{
  $response = 'Please fill in all fields';
}

return  json_encode($response);
?>