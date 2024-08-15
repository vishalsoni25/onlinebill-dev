<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	


  $editCustomerName = $_POST['editCustomerName'];
  $editcustomerNumber = $_POST['editcustomerNumber'];
  $editcustomerPan = $_POST['editcustomerPan'];
  $editcustomerGst = $_POST['editcustomerGst'];
  $editcustomeraddress = $_POST['editcustomeraddress'];$categoriesId = $_POST['editCategoriesId'];
  


	$sql = "UPDATE store_customers SET name = '$editCustomerName', phone = '$editcustomerNumber', address_1 = '$editcustomeraddress', gst = '$editcustomerGst', pan = '$editcustomeraddress' WHERE id = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST