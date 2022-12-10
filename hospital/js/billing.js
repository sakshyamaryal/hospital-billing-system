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
            url: 'hospital/preview', //send data to following url and function
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
    });
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
            url: 'hospital/insertToBilling', //send data to following url and function
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
}