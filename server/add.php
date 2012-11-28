<?php
  include "config.php";

  $id = $_GET['id'];
  $full_name = $_GET['full_name'];
  $email = $_GET['email'];
  $phone = $_GET['phone'];
  $address = $_GET['address'];

  $validate = true;
  $validationError = array();

  if ( $full_name === '' ) {
    $validate = false;
    $validationError[] = array(
      'target' => 'full_name_error',
      'error'  => 'Full name is required'
    );
  }

  if ( $email === '' ) {
    $validate = false;
    $validationError[] = array(
      'target' => 'email_error',
      'error'  => 'Email Id is required'
    );
  }

  if ( $phone !== '' && !is_numeric( $phone ) ) {
    $validate = false;
    $validationError[] = array(
      'target' => 'phone_error',
      'error'  => 'Phone number should be in numeric'
    );
  }


  if ( $validate === true ) {
    if ( empty( $id ) ) {
      $query = "INSERT INTO contacts (full_name, email, phone, address) VALUE ('$full_name', '$email', '$phone', '$address')";
      $result = mysql_query( $query );
      if( $result ) {
        exit( json_encode( array( 'success' => true, 'msg' => 'Saved!' ) ) );
      }
    } elseif ( $id > 0 ) {
      $query = "UPDATE contacts SET full_name = '$full_name', email = '$email', phone = '$phone', address = '$address' WHERE id = '$id'";
      $result = mysql_query( $query );
      if( $result ) {
        exit( json_encode( array( 'success' => true, 'msg' => 'Saved!' ) ) );
      }
    }
  }

  header('Cache-Control: no-cache, must-revalidate');
  header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
  header('Content-type: application/json');
  echo json_encode(
    array(
      'success' => 'false',
      'msg'     => 'there is a problem, please check',
      'validationError' => $validationError
    )
  );
