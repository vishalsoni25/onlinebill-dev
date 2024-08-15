<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

    $customerName = $_POST['customerName'];
  $customerNumber = $_POST['customerNumber']; 
  $customerPan = $_POST['customerPan']; 
  $customerGst = $_POST['customerGst']; 
  $customeraddress = $_POST['customeraddress']; 

	$sql = "INSERT INTO store_customers (name, address_1, phone,gst,pan) 
	VALUES ('$customerName', '$customeraddress', '$customerNumber', '$customerGst', '$customerPan')";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST