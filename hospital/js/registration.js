
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
                url: provincefetch,//send country value to the function
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
                url: munipality,
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
            var url = insert;
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
            url: random, //get econded value from the database form rand function
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


