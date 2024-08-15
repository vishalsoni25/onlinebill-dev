<?php require_once 'includes/header.php'; ?>
  <div class="container">
    <div class="row">
		<div class="col-md-6 mb-3">  
			<div class="calculator" style=" background-color: #fff;
											border-radius: 8px;
											box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
											padding: 30px;
											margin-bottom: 20px;
											margin-top: 20px;">
				<h2 style=" text-align: center;
					margin-bottom: 20px;
					color: #007bff;">
				Jewellery Weight Calculator</h2>
				<form id="calculatorFormWeight">
					<label for="makingChargesWeight">Making Charges:</label>
					<input type="number" id="makingChargesWeight" name="makingChargesWeight" class="form-control mb-3" required>
					<label for="goldRateWeight">Gold Rate (per gram):</label>
					<input type="number" id="goldRateWeight" name="goldRateWeight" class="form-control mb-3" required>
					
					<label for="netWeight">Net Weight:</label>
					<input type="number" id="netWeight" name="netWeight"  class="form-control mb-3" required>
					<label for="hallmarkWeight">Hallmark Price:</label>
					<input type="number" id="hallmarkWeight" name="hallmarkWeight" class="form-control mb-3" required value="45">
				</form>

				<div id="resultsWeight">
					<h2>Results</h2>
					<p id="weightWeight">Weight: <span></span> grams</p>
					<p id="gstWeight">GST: <span></span></p>
					<p id="totalPriceWeight">Grand Price (with GST): <span></span></p>
				</div>
			</div>
		</div>
		
		<div class="col-md-6 mb-3">  
			<div class="calculator" style=" background-color: #fff;
											border-radius: 8px;
											box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
											padding: 30px;
											margin-bottom: 20px;
											margin-top: 20px;">
				<h2 style=" text-align: center;
					margin-bottom: 20px;
					color: #007bff;">
				Jewellery Price Calculator</h2>
				<form id="calculatorForm">
					<label for="makingCharges">Making Charges:</label>
					<input type="number" id="makingCharges" name="makingCharges" class="form-control mb-3" required>
					<label for="goldRate">Gold Rate (per gram):</label>
					<input type="number" id="goldRate" name="goldRate" class="form-control mb-3" required>
					<label for="finalPrice">Final Price:</label>
					<input type="number" id="finalPrice" name="finalPrice"  class="form-control mb-3" required>
					<label for="hallmark">Hallmark Price:</label>
					<input type="number" id="hallmark" name="hallmark" class="form-control mb-3" required value="45">
				</form>

				<div id="results">
					<h2>Results</h2>
					<p id="weight">Weight: <span></span> grams</p>
					<p id="gst">GST: <span></span></p>
					<p id="totalPrice">Total Price (without GST): <span></span></p>
				</div>
			</div>
		</div>
    </div>
  </div>

 <script>
	const calculatorFormWeight = document.getElementById('calculatorFormWeight');
    const weightOutputWeight = document.querySelector('#weightWeight span');
    const gstOutputWeight = document.querySelector('#gstWeight span');
    const totalPriceOutputWeight = document.querySelector('#totalPriceWeight span');

    calculatorFormWeight.addEventListener('input', function() {
      const makingChargesWeight = parseFloat(document.getElementById('makingChargesWeight').value);
      const goldRateWeight = parseFloat(document.getElementById('goldRateWeight').value);
     // const finalPriceWeight = parseFloat(document.getElementById('finalPriceWeight').value);
	 const netWeight = parseFloat(document.getElementById('netWeight').value);
	  const hallmarkWeight = parseFloat(document.getElementById('hallmarkWeight').value);

      // Calculate weight
	  const goldPlusLabour = makingChargesWeight+goldRateWeight;
	  const weightGold = goldPlusLabour*netWeight;
	  const hallmarktotal = weightGold+hallmarkWeight;
	  const gstWeight = hallmarktotal*0.03;
	  const grandTotal = gstWeight+hallmarktotal;
	  //const gstWeight = (finalPriceWeight - (finalPriceWeight*(100/103))).toFixed(2);
	  //const originalPriceWeight = finalPriceWeight - gstWeight;
	  //const priceWithourHallmarkWeight = originalPriceWeight - hallmarkWeight;
      //const weightWeight = ((priceWithourHallmarkWeight - makingChargesWeight) / goldRateWeight).toFixed(2);

      // Calculate GST
     //const gst = (finalPrice * 0.03).toFixed(2);

      // Calculate total price including GST
      //const totalPriceWeight = (finalPriceWeight + parseFloat(gstWeight)).toFixed(2);

      // Update the results
      weightOutputWeight.textContent = hallmarktotal;
      gstOutputWeight.textContent = gstWeight;
      totalPriceOutputWeight.textContent = grandTotal;
    });
 
 
 
    const calculatorForm = document.getElementById('calculatorForm');
    const weightOutput = document.querySelector('#weight span');
    const gstOutput = document.querySelector('#gst span');
    const totalPriceOutput = document.querySelector('#totalPrice span');

    calculatorForm.addEventListener('input', function() {
      const makingCharges = parseFloat(document.getElementById('makingCharges').value);
      const goldRate = parseFloat(document.getElementById('goldRate').value);
      const finalPrice = parseFloat(document.getElementById('finalPrice').value);
	  const hallmark = parseFloat(document.getElementById('hallmark').value);

      // Calculate weight
	  const gst = (finalPrice - (finalPrice*(100/103))).toFixed(3);
	  const originalPrice = finalPrice - gst;
	  const priceWithourHallmark = originalPrice - hallmark;
      const weight = (priceWithourHallmark  / (goldRate+makingCharges)).toFixed(3);

      // Calculate GST
     //const gst = (finalPrice * 0.03).toFixed(2);

      // Calculate total price including GST
      const totalPrice = (finalPrice + parseFloat(gst)).toFixed(3);

      // Update the results
      weightOutput.textContent = weight;
      gstOutput.textContent = gst;
      totalPriceOutput.textContent = originalPrice;
    });
  </script>

<?php require_once 'includes/footer.php'; ?>
