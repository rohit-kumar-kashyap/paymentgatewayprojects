<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <title>Payu money payment gateway</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <!-- BOLT Sandbox/test //-->
        <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
                color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
        <!-- BOLT Production/Live //-->
        <!--// script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script //-->


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
            <form id="contact" action="" method="post">
                <h3><center>Pay-u-money payment gateway</center></h3>

                <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
                <input type="hidden" id="surl" name="surl" value="<?php echo $callback_url; ?>" />
                <input type="hidden" id="key" name="key" placeholder="Merchant Key" value="SCTshJZ0" />
                <input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="a5eRF8wArU" />
                <input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" />
                <input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" />

                <fieldset>
                    <input type="text" name="name" id="fname" placeholder="Your name" tabindex="1" required autofocus>
                </fieldset>
                <fieldset>
                    <input type="email" name="emailaddress" id="email" placeholder="Your Email Address" tabindex="2" required>
                </fieldset>
                <fieldset>
                    <input type="tel" name="mobilenumber" id="mobile" placeholder="Your Phone Number" tabindex="3" required>
                </fieldset>
                <fieldset>
                    <input type="text" name="amount_money" id="amount" placeholder="Amount to pay" tabindex="4" required>
                </fieldset>
                <input type="hidden" id="hash" name="hash" placeholder="Hash" value="" />
                <fieldset align="center">
                    <input type="submit" name="submit_form" id="submit_form" value="Pay" onclick="launchBOLT(); return false;" />
                </fieldset>
            </form>
        </div>
        <!-- partial -->
    </body>
    <script type="text/javascript"><!--
        $('#payment_form').bind('keyup blur', function(){
            $.ajax({
                url: 'mainform/getHash',
                type: 'post',
                data: JSON.stringify({
                    key: $('#key').val(),
                    salt: $('#salt').val(),
                    txnid: $('#txnid').val(),
                    amount: $('#amount').val(),
                    pinfo: $('#pinfo').val(),
                    fname: $('#fname').val(),
                    email: $('#email').val(),
                    mobile: $('#mobile').val(),
                    udf5: $('#udf5').val()
                }),
                contentType: "application/json",
                dataType: 'json',
                success: function(json) {
                    if (json['error']) {
                        $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
                    }
                    else if (json['success']) {
                        $('#hash').val(json['success']);
                    }
                }
            });
        });
        //-->
    </script>

    <script type="text/javascript">
            function launchBOLT()
            {
                bolt.launch({
                    key: $('#key').val(),
                    txnid: $('#txnid').val(),
                    hash: $('#hash').val(),
                    amount: $('#amount').val(),
                    firstname: $('#fname').val(),
                    email: $('#email').val(),
                    phone: $('#mobile').val(),
                    productinfo: $('#pinfo').val(),
                    udf5: $('#udf5').val(),
                    surl : $('#surl').val(),
                    furl: $('#surl').val(),
                    mode: 'dropout'
                },{ responseHandler: function(BOLT){
                        alert(BOLT);
                        console.log( BOLT.response.txnStatus );
                        if(BOLT.response.txnStatus != 'CANCEL')
                        {
                            //Salt is passd here for demo purpose only. For practical use keep salt at server side only.
                            var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
                                '<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
                                '<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
                                '<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
                                '<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
                                '<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
                                '<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
                                '<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
                                '<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
                                '<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
                                '<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
                                '<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
                                '</form>';
                            var form = jQuery(fr);
                            jQuery('body').append(form);
                            form.submit();
                        }
                    },
                    catchException: function(BOLT){
                        alert( BOLT.message );
                    }
                });
            }
    </script>
</html>