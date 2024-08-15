<?php
require_once 'core.php';
$orderid = $_GET['orderid'];
//require_once "../inside.php";
//$ino=$_SESSION['ino'];
//unset($_SESSION['ino']);
$sql = "SELECT order_date, client_name, client_contact, sub_total, vat, total_amount, discount, grand_total, paid, due, payment_type,pan,address,gstin FROM orders WHERE order_id = $orderid";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1];
$clientContact = $orderData[2]; 
$subTotal = $orderData[3];
$vat = $orderData[4];
$totalAmount = $orderData[5]; 
$discount = $orderData[6];
$grandTotal = $orderData[7];
$paid = $orderData[8];
$due = $orderData[9];
$payment_type = $orderData[10];
$pan = $orderData[11];
$address = $orderData[12];
$gstin = $orderData[13];

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bill <?php echo $orderid ?></title>
    <link rel="icon" href="../images/fav.png" type="image/png">
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/roughmemo.css" rel="stylesheet" >
   
    <style>
    

div.a {
  text-align: right;
  margin-right: 50px;
}
div.b{
    text-align: right;
 
}
</style>
   
</head>
    
    <body>

       <!-------------------Main-------------------->
       <main class="container" >
       <!-------------------header-------------------->
       <center>!! JAI MATA KI !!</center>       
       <div class="a"><b>+91 9810356157</b></div>
            <div class="row header">
                <div class="col-xs-4">
                   <img src="images/sj.jpg" width="80%" height="80%">
                </div>
                <div class="col-xs-4">
                   
                </div>
                 
                <div class="col-xs-4">
                    <h2><?php echo "SHAKUNTALAM JEWELLERS" ?></h2>
                        <p>A 399 ,Dabua Colony,Faridabad <br> Near New Poilce Station</p>
                  <h6>Estimated Bill</h6>
                        
                        
                </div>
                


            </div>
            <hr>
            <!-------------------Section-------------------->
            <div class="row section">
                <div class="col-xs-4">
                
                <h4>BILL TO</h4>
                <ul style="list-style-type:none">
                      <li><?php echo $clientName ?>
                </ul>
                </div>
                <div class="col-xs-8">
                     <ul style="list-style-type:none">
                          
                          <li><?php echo  $orderDate ?></li>
                    </ul>               
                </div>
            </div>
            <!-------------------Content-------------------->
            <div class="row content">
                <table class="table">
                        <thead>
                         <tr>
                           <th>#</th>
                            <th>Item Name</th>
                            
                            <th>Net Weight</th>
                            
                            
                            <th>Rate</th>
                           
                            <th>Labour</th>
                            <th>Total Price</th>

                          </tr>
                        </thead>
                        <tbody>
                            <?php   
							echo "<script>console.log('Order Item');</script>";
							$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total, order_item.hsncode,
							product.product_name, order_item.g_weight, order_item.n_weight, order_item.huid, order_item.purity, order_item.grate,
							order_item.hallmark, order_item.l_p_g, order_item.total
							FROM order_item
							INNER JOIN product ON order_item.product_id = product.product_id 
							WHERE order_item.order_id = $orderid";
							$orderItemResult = $connect->query($orderItemSql);
                             $x = 1;
							 //echo "<script>console.log('$x');</script>";
							while($row = $orderItemResult->fetch_array()) {			
							
							 print '<tr>';
                                    print '<td>'.$x.'</td>';
                                    print '<td>'.$row[5].'</td>';
                                   
									
									
									print '<td>'.$row[7].'</td>';
								
									print '<td>'.$row[10].'</td>';
									print '<td>'.$row[12].'</td>';
									print '<td>'.round($row[13],2).'</td>';
                                    print '</tr>';
							$x++;
							}
                              ?>  
                          </tbody>
                    </table>
            </div>
            <!-------------------Footer-------------------->
            <div class="row footer">
               <div class="col-xs-5">
                   
                   <b>Amount in words:</b>
                   
                   <?php
// Create a function for converting the amount in words
function AmountInWords(float $amount)
{
   $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
   // Check if there is any number after decimal
   $amt_hundred = null;
   $count_length = strlen($num);
   $x = 0;
   $string = array();
   $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
     3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
     7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
     10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
     13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
     16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
     19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
     40 => 'fourty', 50 => 'Fifty', 60 => 'Sixty',
     70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $x < $count_length ) {
      $get_divider = ($x == 2) ? 10 : 100;
      $amount = floor($num % $get_divider);
      $num = floor($num / $get_divider);
      $x += $get_divider == 10 ? 1 : 2;
      if ($amount) {
       $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
       $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
       $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
       '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
       '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
        }
   else $string[] = null;
   }
   $implode_to_Rupees = implode('', array_reverse($string));
   $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
   " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
   return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
}
?>

<h6>
 <?php 
 
 
 $get_amount= AmountInWords(round($grandTotal));
 echo $get_amount;
 ?></h6>
               </div>
               <div class="col-xs-4">
                <ul style="list-style-type:none">
                      
                      <li>Sub Total<li>
					  <li>Old Gold/Silver</li>
					  <li>Grand Total</li>
                      <li>Balance<li>
                </ul>               
               </div>
               <div class="col-xs-3">
                <ul style="list-style-type:none">
                     
						<li><?php echo $subTotal; ?> INR</li>
					  <li><?php echo $discount ?> INR</li>
					   <li><?php echo $grandTotal ;?> INR</li>
                       <li><?php echo $due;?> INR</li>
                </ul>               
               </div> 
            </div>
            <!-------------------Another Footer-------------------->
            <div class="row footer2">
                <h3>THANK YOU!</h3> 
                <div class="b" style="margin-right:30px">For shakuntalam jewellers</div>
                <form class="no-print">
                    <input type="button"  class="btn btn-default" value="Print this page" onClick="window.print()">
                    
                </form>
            </div>
            <p class="text-right" style="margin-right:30px">Authorized Signture</p>
            <br><br>
            <b class="h6">Terms And Conditions</b>
            <ol class="h6">
           <li> All disputes are subjected to Faridabad Jurisdiction.</li>
           <li> Any Rejection will be accpeted within one week after delivery.</li>
           <li> Goods once sold not be taken back.</li>
          
            </ol>
        </main>
        
        <script src="../js/bootstrap.min.js"></script>
    
    
</html>