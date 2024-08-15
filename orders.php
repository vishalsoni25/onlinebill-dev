<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
include('function.php');
	

if($_GET['o'] == 'add') { 
// add order
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['o'] == 'manord') { 
	echo "<div class='div-request div-hide'>manord</div>";
} else if($_GET['o'] == 'editOrd') { 
	echo "<div class='div-request div-hide'>editOrd</div>";
} // /else manage order


?>

<div id="insert_customer" class="modal fade">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title">Select An Existing Customer</h4>
		      </div>
		      <div class="modal-body">
				<?php popCustomersList(); ?>
		      </div>
		      <div class="modal-footer">
				<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		      </div>
		    </div><!-- /.modal-content -->
		  </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

				
		
<ol class="breadcrumb">
  <li><a href="dashboard.php">Home</a></li>
  <li>Order</li>
  <li class="active">
  	<?php if($_GET['o'] == 'add') { ?>
  		Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			Manage Order
		<?php } // /else manage order ?>
  </li>
</ol>


<h4>
	<i class='glyphicon glyphicon-circle-arrow-right'></i>
	<?php if($_GET['o'] == 'add') {
		echo "Add Order";
	} else if($_GET['o'] == 'manord') { 
		echo "Manage Order";
	} else if($_GET['o'] == 'editOrd') { 
		echo "Edit Order";
	}
	?>	
</h4>



<div class="panel panel-default">
	<div class="panel-heading">

		<?php if($_GET['o'] == 'add') { ?>
  		<i class="glyphicon glyphicon-plus-sign"></i>	Add Order
		<?php } else if($_GET['o'] == 'manord') { ?>
			<i class="glyphicon glyphicon-edit"></i> Manage Order
		<?php } else if($_GET['o'] == 'editOrd') { ?>
			<i class="glyphicon glyphicon-edit"></i> Edit Order
		<?php } ?>

	</div> <!--/panel-->	
	<div class="panel-body">
			
		<?php if($_GET['o'] == 'add') { 
			// add order
			?>			

			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">
<a href="#" class="float-right select-customer"><b>OR</b> Select Existing Customer</a>
			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label"> <i class="glyphicon glyphicon-calendar"> </i>Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label"> <i class="glyphicon glyphicon-user"></i>Customer Name</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Customer Name" autocomplete="off" />
			    </div>
			    <label for="clientContact" style="padding-top: 18px;" class="col-sm-2 control-label"> <i class="glyphicon glyphicon-earphone"> </i>Customer Number </label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Customer Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
				
				<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label"> <i class="glyphicon glyphicon-lock"></i>PAN</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN Number" autocomplete="off" />
			    </div>
			    <label for="clientContact"  style="padding-top: 18px;" class="col-sm-2 control-label"><i class="glyphicon glyphicon-shopping-cart"></i>GSTIN</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GST Number" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
				
				<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label"><i class="glyphicon glyphicon-home"></i>Address</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" autocomplete="off" />
			    </div>
			  </div> <!--/form-group-->	
			  
<div class="table-responsive">
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:10%;padding-left:30px;">Product</th>
									
			  			<th style="display: none;">HSN Code</th>			  			
						<!--<th style="width:10%;">Gross weight</th>-->			  			
						<th style="width:9%;padding-left:30px;">Net Weight</th>			  			
						<th style="width:9%;padding-left:30px;">HUID</th>			  			
						<!--<th style="width:8%;padding-left:30px;">Purity</th>	-->
						<th style="width:9%;padding-left:30px;">Rate</th>						
						<th style="width:6%;padding-left:10px;">Others</th>			  			
						<th style="width:12%;padding-left:20px;">Labour/per gm</th>	
						<th style="width:12%;padding-left:20px;">gst</th>	
						<th style="width:10%;">Total</th>						
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php
			  		$arrayNumber = 0;
			  		for($x = 1; $x < 2; $x++) { ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;padding-left:30px;">
			  					<div class="form-group">

			  					<select class="form-control" style="width: 130px; height:34px;" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0 order by product_name";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="display: none;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" />			  					
			  				</td>
			  				<td style="display: none;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
			  					</div>
			  				</td>
							<td style="display: none;">
			  					<div class="form-group">
			  					<input type="number" placeholder="HSN Code"  name="hsncode[]" id="hsncode<?php echo $x; ?>"  autocomplete="off" class="form-control" />
			  					<input type="hidden" name="hsncodeValue[]" id="hsncodeValue<?php echo $x; ?>" autocomplete="off" class="form-control" />	
								</div>
			  				</td>
							<!--<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" max="1000000" step=".01" min="0"  placeholder="G.weight" name="g_weight[]" id="g_weight<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" />
			  					</div>
			  				</td>-->
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="N.weight" max="1000000" step=".01" min="0" name="n_weight[]" id="n_weight<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" />
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="text" style="width: 80px; height:34px;" placeholder="HUID" name="huid[]" id="huid<?php echo $x; ?>" class="form-control" />
			  					</div>
			  				</td>
							<!--<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" placeholder="Purity" name="purity[]" id="purity<?php echo $x; ?>" class="form-control" />
			  					</div>-->
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="Rate" name="grate[]" id="grate<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" />
			  					</div>
			  				</td>
							
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="others" name="hallmark[]" id="hallmark<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" />
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" placeholder="Labour/per" name="l_p_g[]" id="l_p_g<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" value="0" />
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
								<input type="number"  style="width: 80px; height:34px;" placeholder="gst" name="gst[]" id="gst<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" value="0" />
			  					
			  					</div>
			  				</td>
							
							
							
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" style="width: 90px; height:34px;" id="total<?php echo $x; ?>" autocomplete="off"  disabled="true" />			  					
			  					<input type="hidden" name="totalValue[]" style="width: 80px;height:34px;" id="totalValue<?php echo $x; ?>" autocomplete="off"  />			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			  </div>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  
				  <div class="form-group" style="display:none;">
				    <label for="vat" class="col-sm-3 control-label">GST 3%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				   <label for="discount" class="col-sm-3 control-label">Old Gold/Silver</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" Value="0"/>
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">UPI</option>
				      	<option value="2">Cash</option>
				      	<option value="3">Credit/Debit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Full Payment</option>
				      	<option value="2">Half Payment</option>
				      	<option value="3">No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
			    </div>
			  </div>
			</form>
		<?php } else if($_GET['o'] == 'manord') { 
			// manage order
			?>

			<div id="success-messages"></div>
		<div class="table-responsive">
			<table class="table" id="manageOrderTable">
			<thead>
			<tr>
				<th>#</th>
				<th>Order Date</th>
				<th>Customer Name</th>
				<th>Contact</th>
				<th>Due</th>
				<th>Payment Status</th>
				<th>Option</th>
			</tr>
			</thead>
   
			</table>
		</div>
			
			

		<?php 
		// /else manage order
		} else if($_GET['o'] == 'editOrd') {
			// get order
			?>
			
			<div class="success-messages"></div> <!--/success-messages-->

  		<form class="form-horizontal" method="POST" action="php_action/editOrder.php" id="editOrderForm">

  			<?php $orderId = $_GET['i'];

  			$sql = "SELECT orders.order_id, orders.order_date, orders.client_name, orders.client_contact, orders.sub_total, orders.vat, orders.total_amount, orders.discount, orders.grand_total, orders.paid, orders.due, orders.payment_type, orders.payment_status,orders.pan, orders.address, orders.gstin FROM orders 	
					WHERE orders.order_id = {$orderId}";

				$result = $connect->query($sql);
				$data = $result->fetch_row();				
  			?>

			  <div class="form-group">
			    <label for="orderDate" class="col-sm-2 control-label"> <i class="glyphicon glyphicon-calendar"> </i>Order Date</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo $data[1] ?>" />
			    </div>
			  </div> <!--/form-group-->
			  <div class="form-group">
			    <label for="clientName" class="col-sm-2 control-label"><i class="glyphicon glyphicon-user"></i>Customer Name</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Customer Name" autocomplete="off" value="<?php echo $data[2] ?>" />
			    </div>
			    <label for="clientContact" style="padding-top: 18px;" class="col-sm-2 control-label"><i class="glyphicon glyphicon-earphone"> </i>Customer Contact</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Customer Number" autocomplete="off" value="<?php echo $data[3] ?>" />
			    </div>
			  </div> <!--/form-group-->		
				<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label"><i class="glyphicon glyphicon-lock"></i>PAN</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="pan" name="pan" placeholder="Enter PAN Number" autocomplete="off" value="<?php echo $data[13] ?>"/>
			    </div>
			    <label for="clientContact" style="padding-top: 18px;" class="col-sm-2 control-label"><i class="glyphicon glyphicon-shopping-cart"></i>GSTIN</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" id="gstin" name="gstin" placeholder="Enter GST Number" autocomplete="off" value="<?php echo $data[15] ?>" />
			    </div>
			  </div> <!--/form-group-->	
				
				<div class="form-group">
			    <label for="clientContact" class="col-sm-2 control-label"><i class="glyphicon glyphicon-home"></i>Address</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" autocomplete="off" value="<?php echo $data[14] ?>" />
			    </div>
			  </div> <!--/form-group-->	

<div class="table-responsive">
			  <table class="table" id="productTable">
			  	<thead>
			  		<tr>			  			
			  			<th style="width:10%;">Product</th>
									
			  					  			
								  			
						<th style="width:9%;">Net Weight</th>			  			
						<th style="width:9%;padding-left:30px;">HUID</th>			  			
						
						<th style="width:9%;padding-left:30px;">Rate</th>						
						<th style="width:6%;padding-left:10px;">Others</th>			  			
						<th style="width:12%;padding-left:20px;">Labour/per gm</th>	
						<th style="width:12%;padding-left:20px;">gst</th>	
						<th style="width:10%;">Total</th>						
			  			<th style="width:10%;"></th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		<?php

			  		$orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.rate, order_item.total, order_item.hsncode, order_item.g_weight, order_item.n_weight, order_item.huid, order_item.purity, order_item.hallmark, order_item.l_p_g,order_item.grate,order_item.gst FROM order_item WHERE order_item.order_id = {$orderId}";
						$orderItemResult = $connect->query($orderItemSql);
						// $orderItemData = $orderItemResult->fetch_all();						
						
						// print_r($orderItemData);
			  		$arrayNumber = 0;
			  		// for($x = 1; $x <= count($orderItemData); $x++) {
			  		$x = 1;
			  		while($orderItemData = $orderItemResult->fetch_array()) { 
			  			// print_r($orderItemData); ?>
			  			<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">			  				
			  				<td style="margin-left:20px;padding-left:30px; ">
			  					<div class="form-group">

			  					<select class="form-control" style="width: 130px; height:34px;" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
			  						<option value="">~~SELECT~~</option>
			  						<?php
			  							$productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
			  							$productData = $connect->query($productSql);

			  							while($row = $productData->fetch_array()) {									 		
			  								$selected = "";
			  								if($row['product_id'] == $orderItemData['product_id']) {
			  									$selected = "selected";
			  								} else {
			  									$selected = "";
			  								}

			  								echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
										 	} // /while 

			  						?>
		  						</select>
			  					</div>
			  				</td>
			  				<td style="display: none;">			  					
			  					<input type="text" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  					<input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['rate']; ?>" />			  					
			  				</td>
			  				<td style="display: none;">
			  					<div class="form-group">
			  					<input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
			  					</div>
			  				</td>
							
							
							
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="N.weight" max="1000000" step=".01" min="0" name="n_weight[]" id="n_weight<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" value="<?php echo $orderItemData['n_weight']; ?>"/>
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="text" style="width: 80px; height:34px;" placeholder="HUID" name="huid[]" id="huid<?php echo $x; ?>" class="form-control" value="<?php echo $orderItemData['huid']; ?>"/>
			  					</div>
			  				</td>
							
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="Rate" name="grate[]" id="grate<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" value="<?php echo $orderItemData['grate']; ?>"/>
			  					</div>
			  				</td>
							
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number" style="width: 80px; height:34px;" placeholder="Others" name="hallmark[]" id="hallmark<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" value="<?php echo $orderItemData['hallmark']; ?>"/>
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number"  placeholder="Labour/per" name="l_p_g[]" id="l_p_g<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" value="<?php echo $orderItemData['l_p_g']; ?>"/>
			  					</div>
			  				</td>
							<td style="padding-left:40px;">
			  					<div class="form-group">
			  					<input type="number"  style="width: 80px; height:34px;" placeholder="gst" name="gst[]" id="gst<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off"class="form-control" value="<?php echo $orderItemData['gst']; ?>"/>
			  					</div>
			  				</td>
							
			  				<td style="padding-left:20px;">			  					
			  					<input type="text" name="total[]" style="width: 90px; height:34px;" id="total<?php echo $x; ?>" autocomplete="off"  disabled="true" value="<?php echo $orderItemData['total']; ?>"/>			  					
			  					<input type="hidden" name="totalValue[]" style="width: 90px; height:34px;" id="totalValue<?php echo $x; ?>" autocomplete="off"  value="<?php echo $orderItemData['total']; ?>"/>			  					
			  				</td>
			  				<td>

			  					<button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
			  				</td>
			  			</tr>
		  			<?php
		  			$arrayNumber++;
		  			$x++;
			  		} // /for
			  		?>
			  	</tbody>			  	
			  </table>
			  </div>

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[4] ?>" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[4] ?>" />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group" style="display:none;">
				    <label for="vat" class="col-sm-3 control-label">GST 3%</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[5] ?>"  />
				      <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[5] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[6] ?>" />
				      <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[6] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="discount" class="col-sm-3 control-label">Old Gold/Silver</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off" value="<?php echo $data[7] ?>" />
				    </div>
				  </div> <!--/form-group-->	
				  <div class="form-group">
				    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value="<?php echo $data[8] ?>"  />
				      <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" value="<?php echo $data[8] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  		  
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	<div class="form-group">
				    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value="<?php echo $data[9] ?>"  />
				    </div>
				  </div> <!--/form-group-->			  
				  <div class="form-group">
				    <label for="due" class="col-sm-3 control-label">Due Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" id="due" name="due" disabled="true" value="<?php echo $data[10] ?>"  />
				      <input type="hidden" class="form-control" id="dueValue" name="dueValue" value="<?php echo $data[10] ?>"  />
				    </div>
				  </div> <!--/form-group-->		
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentType" id="paymentType" >
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[11] == 1) {
				      		echo "selected";
				      	} ?> >UPI</option>
				      	<option value="2" <?php if($data[11] == 2) {
				      		echo "selected";
				      	} ?>  >Cash</option>
				      	<option value="3" <?php if($data[11] == 3) {
				      		echo "selected";
				      	} ?> >Credit Card</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
				  <div class="form-group">
				    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
				    <div class="col-sm-9">
				      <select class="form-control" name="paymentStatus" id="paymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1" <?php if($data[12] == 1) {
				      		echo "selected";
				      	} ?>  >Full Payment</option>
				      	<option value="2" <?php if($data[12] == 2) {
				      		echo "selected";
				      	} ?> >Half Payment</option>
				      	<option value="3" <?php if($data[10] == 3) {
				      		echo "selected";
				      	} ?> >No Payment</option>
				      </select>
				    </div>
				  </div> <!--/form-group-->							  
			  </div> <!--/col-md-6-->


			  <div class="form-group editButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			    <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['i']; ?>" />

			    <button type="submit" id="editOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
			      
			    </div>
			  </div>
			</form>

			<?php
		} // /get order else  ?>


	</div> <!--/panel-->	
</div> <!--/panel-->	


<!-- edit order -->
<div class="modal fade" tabindex="-1" role="dialog" id="paymentOrderModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
      </div>      

      <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;" >

      	<div class="paymentOrderMessages"></div>

      	     				 				 
			  <div class="form-group">
			    <label for="due" class="col-sm-3 control-label">Due Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="due" name="due" disabled="true" />					
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
			    <div class="col-sm-9">
			      <input type="text" class="form-control" id="payAmount" name="payAmount"/>					      
			    </div>
			  </div> <!--/form-group-->		
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentType" id="paymentType" >
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">UPI</option>
			      	<option value="2">Cash</option>
			      	<option value="3">Credit/Debit Card</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  
			  <div class="form-group">
			    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
			    <div class="col-sm-9">
			      <select class="form-control" name="paymentStatus" id="paymentStatus">
			      	<option value="">~~SELECT~~</option>
			      	<option value="1">Full Payment</option>
			      	<option value="2">Half Payment</option>
			      	<option value="3">No Payment</option>
			      </select>
			    </div>
			  </div> <!--/form-group-->							  				  
      	        
      </div> <!--/modal-body-->
      <div class="modal-footer">
      	<button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
      </div>           
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit order-->

<!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Order</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->
		
		
		
		
		








<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>
