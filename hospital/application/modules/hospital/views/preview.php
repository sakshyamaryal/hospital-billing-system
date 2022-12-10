<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url() ?>css/patientView.css">

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

<div class="container mt-5 px-2">

    <div class="mb-2 d-flex justify-content-between align-items-center">


    </div>
    <div class="table-responsive">
        <table class="table table-responsive table-borderless">

            <thead>
                <tr class="bg-info">
                    <th class="" scope="col">S.N</th>
                    <th scope="col" width="10%">Patient Id</th>
                    <th scope="col">Name</th>
                    <th scope="col" width="13%">Mobile Number</th>
                    <th scope="col">Age/Sex</th>
                    <th scope="col">Country/Province/Municipality</th>
                    <th scope="col">Registered Date</th>
                    <th scope="col">Language</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($arr as $key) { ?>
                    <tr class="mytable">
                        <td><?= $i++; ?></td>
                        <td>HM-<?= $key['patient_id']; ?></td>
                        <td><img src="https://i.imgur.com/VKOeFyS.png" width="25">&nbsp;<?= $key['name']; ?></td>
                        <td>&nbsp;<?= $key['mobile']; ?></td>
                        <td><i class="fa fa-check-circle-o green"></i><span class="ms-1"><?= $key['age'] . ' Y / ' . $key['gender']; ?></span></td>
                        <td><?= $key['country'] . '/' . $key['province'] . '/' . $key['municipality'] ?></td>
                        <td><?= $key['date']; ?></td>
                        <td><?= $key['language']; ?></td>
                        <td>
                            <button class="btn btn-primary d-flex align-items-center btn-warning" type="button" id='total' value="<?= $key['patient_id']; ?> ">Billings</a>
                            </button>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>

        <script>
            $(document).ready(function() {
                patientIdFetch()

            });

            function patientIdFetch() {
                $('#total').click(function() {
                    var patientid = $(this).val();
                    $.ajax({
                        url: '<?php echo base_url() ?>hospital/preview', //send value to the preview function
                        type: 'GET',
                        data: {
                            patientid //send get request patient id to controler function
                        }
                    });
                    window.location.replace(<?php base_url() ?> 'billingsAndTotal');
                });

            }
        </script>