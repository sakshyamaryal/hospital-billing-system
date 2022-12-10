<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Registration</title>

    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>css/styles.css">


</head>

<body>
    <div class="panel panel-primary" style="margin:20px;">
        <div class="panel-heading">
            <h3 class="panel-title">Registration Only</h3>
        </div>
        <div class="panel-body">
            <div class="msg"></div>
            <h3 class="panel-title">Basic Information</h3>
            <br><br>
            <form method="POST" action="">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="name">Name* </label>
                        <input type="text" class="form-control input-sm" id="name" placeholder="" name="name">
                    </div>



                    <div class="form-group col-md-6 col-sm-6">
                        <label for="mobile">Age*</label>
                        <input type="text" class="form-control input-sm" id="age" placeholder="" name="age">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="mobile">Gender*</label><br>
                        <input type="radio" class="gender" name="option" value="m">
                        <label for="male">Male</label>
                        <input type="radio" class="gender" name="option" value="f">
                        <label for="female">Female</label>

                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="mobile">language*</label><br>
                        <input type="checkbox" id="nepali" name="lang" value="Nepali">
                        <label for="nepali">Nepali</label>
                        <input type="checkbox" id="hindi" name="lang" value="Hindi">
                        <label for="hindi">Hindi</label>
                        <input type="checkbox" id="english" name="lang" value="English">
                        <label for="english">English</label>
                    </div>

                </div>

                <div class="col-md-12 col-sm-12" id="deceased">

                    <h3 class="panel-title">Contact Information</h3><br><br>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="address">Address*</label>
                        <input type="text" class="form-control input-sm" id="address" placeholder="" name="address">
                    </div>
                    <div class="form-group col-md-6 col-sm-6">
                        <label for="number">Mobile*</label>
                        <input type="text" class="form-control input-sm" id="mobile" placeholder="" name="mobile">
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="country">Select Country *</label>
                        <select class="form-control input-sm" id="country" name="country">
                            <option>-- Country --</option>
                            <?php
                            if (!empty($countries)) {
                                foreach ($countries as $country) {
                                    echo '<option value=" ' . $country['id'] . ' " >' . $country['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="province">Select Province *</label>
                        <select class="form-control input-sm" id="province" name="province">
                            <option>-- Province No --</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6 col-sm-6">
                        <label for="muni">Municipality. *</label>
                        <select class="form-control input-sm" id="municipal" name="municipality">
                            <option>-- Municipality --</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12" id="addblock">
                    <div class="form-group col-md-3 col-sm-3">
                        <!-- <input type="button" class="btn btn-primary" value="submit" id="submit" />
                     -->
                     <button class="btn btn-primary" type="button" id="submit">Submit</button>
                    </div>
                </div>

        </div>
        </form>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        province_municiple();//function call

    });

    function province_municiple() {

        $('#country').change(function() {
            var country = $(this).val();
            console.log(country);
            var select = '';
            var muni = '';
            $.ajax({
                url: ' <?php echo base_url() ?>hospital/provinceFetch',//send country value to the function
                type: 'POST',//data navigation type
                data: {
                    country
                },
                dataType: 'json',
                success: function(successMessage) {
                    if (successMessage['province']) {
                        // alert(successMessage['province']);
                        $('#province').html(successMessage['province']); //show provinces from the anoter page from contoller
                    }
                    if (country == "-- Country --") {
                        select += '<option>-- Province No --</option>';
                        $('#province').html(select);  //cannot select data if value is country
                    }
                    if (country || !country) {
                        muni += '<option>-- Municipality --</option>';
                        $('#municipal').html(muni); //cannot select data if value is municipality
                    }
                }
            });
        });

        $('#province').change(function() { //change function
            var province = $(this).val();
            var select = '';
            $.ajax({
                url: ' <?php echo base_url() ?>hospital/municipalFetch',
                type: 'POST',
                data: {
                    province
                },
                dataType: 'json',
                success: function(message) {
                    if (message['mun']) {
                        // alert(message['mun']);
                        $('#municipal').html(message['mun']);
                    }
                }
            });
        });

        $('.gender').click(function() { //get gender value
            $('input[name="option"]:checked').each(function() {
                var gender = this.value;
                sessionStorage.setItem("gender", gender);
            });
        });

        

        $('#submit').click(function() {
            randomNumber();//generate random number function if value exist incremnt last vlaue by 1
            languages(); // language
            var name = $('#name').val();
            var age = $('#age').val();
            var gender = sessionStorage.getItem("gender");
            var language = sessionStorage.getItem("language");
            var countryname = $('#country').find(":selected").text();
            var provincename = $('#province').find(":selected").text();
            var munipality = $('#municipal').find(":selected").text();
            var address = $('#address').val();
            var mobile = $('#mobile').val();
            var date = new Date();
            var patientid = sessionStorage.getItem("patientid");
            var municipality_id = $('#municipal').val();
            var url = "<?php echo base_url() . "hospital/insertRegistrationData" ?>";
            $.post(url, {
                    name,
                    age,
                    gender,
                    language,
                    countryname,
                    provincename,
                    munipality,
                    address,
                    mobile,
                    date,
                    patientid,
                    municipality_id
                },
                function(checkdata) {
                    checkdata = JSON.parse(checkdata);
                    if (checkdata.status == 'success') {
                        alert(checkdata.message);
                    } else if (checkdata.status == 'failed') {
                        $('.msg').html(checkdata.message);
                    } else {
                        alert(checkdata.messages);
                    }
                });//check if the validation is correct or not else throw valdiation error message

 
        });
    }

    function languages() { //store language
        var languages = [];
        $.each($("input[name='lang']:checked"), function() {
            languages.push($(this).val()); //push to array
        });
        var lang = languages.join(", "); //join all the value selected with comma (,)
        sessionStorage.setItem("language", lang);
    }

    function randomNumber(){
        var patientid = Math.floor((Math.random() * 100000000) + 5000);//generate random numbers
                        sessionStorage.setItem("patientid",patientid); 
        $.ajax({
            type: 'ajax',
            url: 'hospital/rand', //get econded value from the database form rand function
            async: false,
            dataType: 'json',
            success: function(rand) {
                    if(rand.patient_id){                        
                        patientid = ++rand.patient_id; //increment by 1 of the last value if number exists
                        sessionStorage.setItem("patientid",patientid);
                    }
            }
        });
        
    }


</script>