<?php

  include 'config.php';

  $id = $_GET['id'];
  $query = "DELETE FROM contacts WHERE id = '$id' ";

  $result = mysql_query( $query );
  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Content-type: application/json');
  if ($result) {
    echo json_encode( array( 'success' => true ) );
  } else {
    echo json_encode(
      array(
        'success' => false,
        'msg' => 'Something wrong'
      )
    );
  }
