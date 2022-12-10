<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/patientView.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/styles.css">

<nav class="navbar navbar-inverse" id="tech">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Midas Technologies</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo base_url(); ?>hospital/patientDetails">Home</a></li>
        </ul>
    </div>
</nav>
<form action="" method="post">
    <div class="container mt-5 px-2 p-3 mb-2 ">

        <div class="mb-2 d-flex justify-content-between align-items-center">

            <div class="col-md-12 col-sm-12" id="deceased">
                <div class="msg"></div>

                <h3 class="panel-title">Billing</h3><br><br>
                <div class="form-group col-md-6 col-sm-6">

                    <label for="">Patient ID*</label>
                    <div class="patient">

                    </div>
                    <form action="" method="post">
                        <button class="btn btn-info" type="submit" id="go" name="submit">View Tests</button>
                    <button class="btn btn-danger" type="button" id="clear">clear</button>
                    <button class="btn btn-success" type="button" id="add">Add</button>

                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table ">
            <thead>
                <tr class="bg-danger">
                    <th class="bg-primary" scope="col"></th>
                    <th class="bg-primary" scope="col"><input type="text" class="form-control input-sm" id="test_item" placeholder="Test Items" name="test_item"></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="quantity" placeholder="quantity" name="qty" name="quantity"></th>
                    <th class="bg-primary" scope="col"><input type="text" class="form-control input-sm" id="unit" placeholder="unit" name="unit"></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="price" placeholder="price" name="price"></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="sub_total" placeholder="Sub Total" name="subtotal" readonly></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="discount_percent" placeholder="Discout%" name="discount_percent"></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="amount" placeholder="Amount" name="discount_amount" readonly></th>
                    <th class="bg-primary" scope="col"><input type="number" class="form-control input-sm" id="net_total" placeholder="Net Total" name="net_total" readonly></th>

                </tr>
            </thead>

            <thead>
                <tr class="bg-primary">
                    <th class="bg-primary" scope="col">S.N</th>
                    <th class="bg-primary" scope="col">Test Items</th>
                    <th class="bg-primary" scope="col">Qunatity</th>
                    <th class="bg-primary" scope="col">Unit</th>
                    <th class="bg-primary" scope="col">Price</th>
                    <th class="bg-primary" scope="col">&nbsp;Sub Total</th>
                    <th class="bg-primary" scope="col">&nbsp;Discount%</th>
                    <th class="bg-primary" scope="col">&nbsp;&nbsp;Discount Amt</th>
                    <th class="bg-primary" scope="col">&nbsp;&nbsp;&nbsp;Net Total</th>
                    <!-- <th class="bg-primary" scope="col"></th> -->
                </tr>
            </thead>

            <tbody id="fade">
                <?php
                if (isset($_POST['submit'])) {
                    if (!empty($patienttestings)) {
                        $i = 1;
                        foreach ($patienttestings as $key) { ?>
                            <tr class="bg-light">
                                <td class="bg-" scope="col"><?= $i++ ?></td>
                                <td class="bg-" scope="col"><?= $key['test_items']; ?></td>
                                <td class="bg-" scope="col"><?= $key['quantity'];  ?></td>
                                <td class="bg-" scope="col"><?= $key['unit']; ?></td>
                                <td class="bg-" scope="col"><?= $key['price']; ?> Rs</td>
                                <td class="bg-" scope="col">&nbsp;<?= $key['subtotal']; ?> Rs</td>
                                <td class="bg-" scope="col">&nbsp;<?= $key['discount_percent']; ?> %</td>
                                <td class="bg-" scope="col">&nbsp;&nbsp;<?= $key['discount_amount']; ?> Rs</td>
                                <td class="bg-" scope="col">&nbsp;&nbsp;&nbsp;<?= $key['net_total']; ?> Rs</td>
                                <!-- <td class="bg-" scope="col"> -->
                                    </th>
                            </tr>

                <?php     
            }
                    }
                } ?>
            </tbody>

        </table>
    </div>

    </div>
    </table>
</form>

<script>
    var patientIdArray = [];
    $(document).ready(function() {
        //functions
        search();
        navigteBillingData();
        subTotal();
        discoutAmount_netTotal();
        subTotal();
        patientIdFetch();

    });

    function patientIdFetch() {
        $.ajax({
            type: 'ajax',
            url: 'hospital/fetchSinglePatient', //url for getting encoded data from the controler and functin
            async: false,
            dataType: 'json',
            success: function(patient_id) {
                var patient = '';

                if (patient_id) {
                    patient += '<input type="text" class="form-control input-sm" id="patient_id" placeholder="" name="address" name="patient_id" value=' + patient_id + ' readonly>';
                    $('.patient').html(patient); //input field
                } else {
                    patient += '<input type="text" class="form-control input-sm" id="patient_id" placeholder="" name="address" name="patient_id" >';
                    $('.patient').html(patient);
                }
            }
        });
        // get patient id in the input field
    }
    
    function search() { //search patient id and fetch the value with request
        $('#go').click(function() {
            var patientid = $('#patient_id').val();
            $.ajax({
                url: '<?php echo base_url() ?>hospital/preview', //send data to following url and function
                type: 'GET',
                data: {
                    patientid
                }
            });
            
        });
        total();
    }

    function checkPatientId() { //check if patiend id exits or not
        $('#submit').click(function() {
            var patientid;
            $.ajax({
                type: 'ajax',
                url: 'hospital/fetchPatientId',
                async: false,
                dataType: 'json',
                success: function(val) {
                    patientid = $('#patient_id').val();
                    var index;
                    for (index = 0; index < val.length; index++) {
                        if (patientid == val[index].patient_id) {
                            $('.p').html("You Can Continue");
                        } else {
                            $('.p').html("ThankYou");
                        }
                    }
                }
            });
        });
    }

    function navigteBillingData() {
        //send data to the billing function
        $('#clear').click(function(){
            $('#test_item').val('');
            $('#quantity').val('');
            $('#unit').val('');
            $('#price').val('');
            parseFloat($('#discount_percent').val(''));
        })
        $('#add').click(function() {
            randomNumber(); //get random number if exists increment by 1
            var patient_id = $('#patient_id').val();
            var billing_date = new Date();
            var test_item = $('#test_item').val();
            var quanity = $('#quantity').val();
            var unit = $('#unit').val();
            var price = $('#price').val();
            var subtotal = price * quanity;
            var discout_percent = parseFloat($('#discount_percent').val());
            var discount_amount = $('#amount').val();
            var net_total = $('#net_total').val();
            var sample_no = sessionStorage.getItem("sample_num");
            // values of all the fields

            $.ajax({
                url: ' <?php echo base_url() ?>hospital/insertToBilling', //send data to following url and function
                type: 'POST',
                data: {
                    patient_id,
                    sample_no,
                    billing_date,
                    subtotal,
                    discout_percent,
                    discount_amount,
                    net_total,
                    test_item,
                    quanity,
                    unit,
                    price
                    //navigate the following above values,data
                },
                dataType: 'json',
                success: function(checkdata) {
                    if (checkdata.status == 'success') { //check if the registration is success or not
                        alert(checkdata.message);
                    } else if (checkdata.status == 'failed') {
                        $('.msg').html(checkdata.message);
                    } else {
                        alert(checkdata.messages);
                        //validation error function message
                    }
                }
            });
        });
    }

    function subTotal() { //get subtoal in keyup function (auto generate)
        $('#price, #quantity').keyup(function() {
            var price = parseFloat($('#price').val()); //change to float datatype or accept float datatype
            var qty = parseFloat($('#quantity').val());
            var subtotal = $('#sub_total').val(price * qty);
            //multiply two fields
        });
    }

    function discoutAmount_netTotal() {
        //get discount amount and net total
        $('#price, #quantity,#discount_percent').keyup(function() {
            var price = parseFloat($('#price').val()); // accept float value
            var qty = parseFloat($('#quantity').val()); // accept float value
            var subtotal = price * qty;
            var discoutPercent = parseFloat($('#discount_percent').val()); // discount percent
            var discoutAmount = discoutPercent / 100 * subtotal; // get discount amount after dividing by 100  and times subtotal value
            $('#amount').val(discoutAmount);
            var net_total = $('#net_total').val(subtotal - discoutAmount);
            //get net total
        });
    }

    function randomNumber() {
        var sample_no = Math.ceil((Math.random() * 100000000) + 5000);
        sessionStorage.setItem("sample_num", sample_no); // generate random value
        $.ajax({
            type: 'ajax',
            url: 'hospital/sample_number', //get encoded data
            async: false,
            dataType: 'json',
            success: function(random) {
                if (random.sample_no) {
                    // if last sample number exists increment by 1 (prefix)                 
                    sample_no = ++random.sample_no;
                    sessionStorage.setItem("sample_num", sample_no); //store in session
                }
            }
        });
    }
    function total(){
            // $.ajax({
            //     type: 'ajax',
            //     url: 'hospital/billingTotal',
            //     async: false,
            //     dataType: 'json',
            //     success: function(total) {
            //         var index;
            //         var sum = 0;
            //         // var total = 0;
            //         for (index = 0; index < total.length -1; index++) {
            //             for (let i = 1; index < total.length; index++) {
            //                  total[index].price = total[index].prce; 
            //             }
                        
            //         }
                    
            //         alert(sum);
                    

            //     }
            // });
    }
</script>