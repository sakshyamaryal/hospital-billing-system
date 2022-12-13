<?php 
if(!$_SESSION['username'] && !$_SESSION['password']){
    header('location:'.base_url().'hospital');
}?>
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
            <li class="primary"><a href="<?=base_url() ?>hospital/billing">Recent Test Billing</a></li>
            <li class="primary"><a href="<?php echo base_url(); ?>hospital/logout">Logout</a></li>
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
                            <button class="btn btn-primary d-flex align-items-center btn-warning" type="button" id='btn2' value="<?= $key['patient_id']; ?> ">Delete Patient</a>
                            </button>
                        </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>
    </div>

</div>
<script>
var previewdata = <?php  base_url() ?> 'viewPreviewData'; //url for getting preview data in js file
var billing = <?php base_url() ?> 'billing';
var previews = <?php base_url() ?> 'hospital/preview';
dlt();
function dlt() { 
        $("button:nth-child(3)").click(function(){
           var patientid = $(this).val();//first button to be selected and generate patient id
            $.ajax({
                url: '<?php echo base_url() ?>hospital/delete',//send get request to the function
                type: 'POST',
                data: {
                    patientid // sending patentid to preview Page
                }
                
            });
            
            alert("Deleted");
            window.location.replace('hospital/patientDetails');
        });
     }    

</script>
<script src="<?php echo base_url(); ?>js/managePatient.js"></script>