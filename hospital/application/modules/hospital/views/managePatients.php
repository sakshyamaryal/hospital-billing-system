<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/patientView.css">


<nav class="navbar navbar-inverse" id="tech">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Midas Technologies</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?=base_url() ?>hospital/billing">Recent Test Billing</a></li>
        </ul>
    </div>
</nav>

<div class="container mt-5 px-2">

    <div class="mb-2 d-flex justify-content-between align-items-center">

        <div class="position-relative">
            <span class="position-absolute search"><i class="fa fa-search"></i></span>
            <input class="form-control w-100" placeholder="Search Here" id="search">
        </div>

        <div class="px-2">

            <span>Filters <i class="fa fa-angle-down"></i></span>
            <i class="fa fa-ellipsis-h ms-3"></i>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table table-responsive table-borderless">

            <thead>
                <tr class="bg-light">
                    <th scope="col" width="5%">S.N</th>
                    <th scope="col" width="20%">Patient Id</th>
                    <th scope="col" width="20%">Name</th>
                    <th scope="col" width="10%">Age/Sex</th>
                    <th scope="col" width="20%">District</th>
                    <th scope="col" width="20%">Registered Date</th>
                    <th scope="col" class="text-end" width="20%"><span>Action</span></th>
                </tr>
            </thead>
            <tbody>
                
                    <?php
                    $i = 1;
                    foreach ($patient as $key) { ?>
                    <tr class="mytable">
                        <td><?= $i++; ?></td>
                        <td>HM-<?= $key['patient_id']; ?></td>
                        <td><img src="https://i.imgur.com/VKOeFyS.png" width="25">&nbsp;<?= $key['name']; ?></td>
                        <td><i class="fa fa-check-circle-o green"></i><span class="ms-1"><?= $key['age'] . ' Y / ' . $key['gender']; ?></span></td>
                        <td><?=  $key['district_name']; ?></td>
                        <td><?= $key['date']; ?></td>
                        <td class="text-end">
                            <button class="btn btn-primary d-flex align-items-center btn-danger" type="button" id='preview' value="<?= $key['patient_id']; ?> ">preview</a>
                            </button>

                            <button class="btn btn-primary border-success align-items-center btn-success" type="button" id='billing' value="<?= $key['patient_id']; ?> ">
                                <div class="reg">Registration Billing</div></button>
                        </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>
    </div>

</div>
<script>
$(document).ready(function(){
    //function calls
    searchbar();
    registrationBillingPage();
    preview();
});

function searchbar() {
    // search bar keyup function
    $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase(); //searchbar value of each key inserted
    $(".mytable").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1) //check and view value
    });
  });
  }

  function registrationBillingPage(){
        $('button:nth-child(2)').click(function(){ //seond button to be selected
            var patientid = $(this).val(); //value of selected buton to be generated 
            $.ajax({
                url: '<?php echo base_url() ?>hospital/preview',//send value to the preview function
                type: 'GET',
                data: {
                    patientid //send get request patient id to controler function
                },  
                success:function(data) {
                    window.location.replace(<?php base_url() ?> 'billing');//refresh the page to billing view
                }
               
            });
        });
    }

    function preview() { 
        $("button:first-child").click(function(){
           var patientid = $(this).val();//first button to be selected and generate patient id
            $.ajax({
                url: '<?php echo base_url() ?>hospital/preview',//send get request to the function
                type: 'GET',
                data: {
                    patientid // sending patentid to preview Page
                },  
                success:function(data) {
                    window.location.replace(<?php base_url() ?> 'viewPreviewData'); //replace the function
                }
               
            });
            
        });
     }
</script>