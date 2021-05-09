<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Razorpay payment result page</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
    <style>
        #submit_form_result{
            border: none;
            padding: 10px;
            border-radius: 5px;
            color: #4caf50;
            background-color: #fff;
            font-weight: 600;
        }
        #result_heading{
            font-size: 25px;
            padding-top: 20px;
        }
    </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <h3 id="result_heading"><center>Razorpay Payment Result</center></h3>
    <fieldset align="center" style="color:#fff;">
        <?php if ($_SESSION['PAYMENT_STATUS'] == true){ ?>
            <h1>Payment Successful</h1>
        <?php } else{ ?>
            <h1>Payment Failed</h1>
        <?php } ?>
    </fieldset>
    <fieldset align="center">
        <button type="submit" name="submit_form" id="submit_form_result" data-submit="...Sending" onclick="location.href = 'http://127.0.0.1/payment_gateway_projects/razorpay_gateway/';">Return to homepage</button>
    </fieldset>
</div>
<!-- partial -->
</body>
</html>