<?php 
if(!$_SESSION['username'] && !$_SESSION['password']){
    header('location:'.base_url().'hospital');
}?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/patientView.css">
<link rel="stylesheet" href="<?php echo base_url() ?>css/styles.css">


<nav class="navbar navbar-inverse" id="tech">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url(); ?>hospital/patientDetails">Midas Technologies</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="primary"><a href="<?php echo base_url(); ?>hospital/patientDetails">Home</a></li>
            <li class="primary"><a href="<?php echo base_url(); ?>hospital/logout">Logout</a></li>
        </ul>
    </div>
</nav>

<?php if (!empty($billingtotal)) { ?>
    <h1>Welcome, patient information with tests and billings</h1>
    <div class="table-responsive">
        <table class="table table-responsive table-borderless">
            <thead>
                <tr class="bg-primary">
                    <th class="bg-primary" width="2%" scope="col">S.N</th>
                    <th class="bg-primary" width="10%" scope="col">Billing Date</th>
                    <th class="bg-primary" width="10%" scope="col">Test Item</th>
                    <th class="bg-primary" width="10%" scope="col">SampleNo</th>
                    <th class="bg-primary" width="10%" scope="col">Quanity</th>
                    <th class="bg-primary" width="10%" scope="col">Unit</th>
                    <th class="bg-primary" width="10%" scope="col">Price(NPR)</th>
                    <th class="bg-primary" width="10%" scope="col">Sub Total(NPR)</th>
                    <th class="bg-primary" width="10%" scope="col">Discount%</th>
                    <th class="bg-primary" width="10%" scope="col">Discount Amt</th>
                    <th class="bg-primary" width="10%" scope="col">Net Total</th>
                </tr>

            </thead>
            <tbody>
                <?php
                $sn = 1;
                foreach ($billingtotal as $key) { ?>
                    <tr class="bg-light">
                        <td scope="col"><?= $sn++; ?></td>
                        <td scope="col"><?= $key['billing_date'] ?></td>

                        <td scope="col"><?= $key['test_items'] ?></td>
                        <td scope="col">SHM-<?= $key['sample_no'] ?></td>
                        <td scope="col"><?= $key['quantity'] ?></td>
                        <td scope="col"><?= $key['unit'] ?></td>
                        <td scope="col"><?= $key['price'] ?></td>
                        <td scope="col"><?= $key['subtotal'] ?></td>
                        <td scope="col"><?= $key['discount_percent'] ?>%</td>
                        <td scope="col">NPR <?= $key['discount_amount'] ?></td>
                        <td scope="col">NPR <?= $key['net_total'] ?></td>

                    </tr>


                <?php }

                ?>
            </tbody>

        </table>


    </div>

    </div>
    <div class="panel panel-primary" style="margin:20px;">
        <div class="panel-heading">
            <h3 class="panel-title">Billing Information</h3>
        </div>
        <div class="panel-body">
            <div class="msg"></div>
            <h3 class="panel-title">Totaling billing amounts information:</h3>
            <br><br>
            <form method="POST" action="">
                <form action="">
                    <div class="col-md-6 col-sm-6">


                        <label for="name">Total Price of Test Items Of a Patient* </label>
                        <p class="price"></p><br>

                        <label for="mobile">Sub total without discount*</label>
                        <Div class="subtotal"></Div><br><br>

                        <div class="form-group col-md-6 col-sm-6">
                            <label for="mobile">Total Discounts*</label>
                            <Div class="discount"></Div>

                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <label for="mobile">Net total including discounts*</label>
                            <Div class="nettotal"></Div>

                        </div>


                    </div>


        </div>

    </div>
    </form>
    </div>
<?php
} else { ?>
    <H1>Patient Test Does Not exist</H1>
<?php } ?>
<script src="<?php echo base_url(); ?>js/patientBilling.js"></script>
<script>
  
</script>