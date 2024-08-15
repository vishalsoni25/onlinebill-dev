<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Print</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
	h1 {
            color: #ffd700;
        }
	 </style>
</head>
<body>
    <div class="container">
        <center><h1 class="mt-5">Shakuntalam Jewellers</h1></center>
        <div class="mt-3">
            <?php
            if(isset($_GET['response'])) {
                $response = urldecode($_GET['response']);
                // Print the response data
                echo $response;
            } else {
                echo "No response data available";
            }
            ?>
        </div>
    </div>
</body>
</html>
