<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Razorpay payment gateway</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css');?>">
        <style>
            #submit_form{
                border: none;
                padding: 12px;
                padding-left: 25px;
                padding-right: 24px;
                background-color: #4CAF50;
                color: #fff;
                font-weight: bold;
                border-radius: 5px;
            }
        </style>
    </head>
    <body>
        <!-- partial:index.partial.html -->
        <div class="container">
            <form id="contact" action="<?php echo base_url('mainform/savedata');?>" method="post">
                <h3><center>Razorpay Payment Gateway</center></h3>
                <fieldset>
                    <input type="text" name="name" id="name" placeholder="Your name" tabindex="1" required autofocus>
                </fieldset>
                <fieldset>
                    <input type="email" name="emailaddress" id="emailaddress" placeholder="Your Email Address" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input type="tel" name="mobilenumber" id="mobilenumber" placeholder="Your Phone Number" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <input type="text" name="amount_money" id="amount_money" placeholder="Amount to pay" tabindex="4" required>
                </fieldset>
                <fieldset align="center">
                    <input type="submit" name="submit_form" id="submit_form" value="Pay" data-submit="...Sending">
                </fieldset>
            </form>
        </div>
        <!-- partial -->
    </body>
</html>