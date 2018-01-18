<?php
error_reporting(E_ALL);
ini_set('display_errors','0');
include('../dbconfig.php');
$action = $_GET['action'];
//$action = $_GET['action'];
if (!empty($action))
{
  $sql="SELECT alias, direccion1, direccion2, activo FROM empresas where id_empresa = :codigo order by alias";
  $stmt=$db_con->prepare($sql);
  $stmt->execute(array(
    ':codigo'=>$action,
    ));
  if($stmt->rowCount() > 0)
  {
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($row);
  }
  else echo json_encode('2');
}
  else echo json_encode('2');
?>
