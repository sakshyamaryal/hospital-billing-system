<?php 
if(!$_SESSION['username'] && !$_SESSION['password']){
    header('location:'.base_url().'hospital');
}?>
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
            <li class="primary"><a href="<?php echo base_url(); ?>hospital/patientDetails">Home</a></li>
            <li class="primary"><a href="<?php echo base_url(); ?>hospital/logout">Logout</a></li>
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
  
</script>

<script src="<?php echo base_url();?>js/billing.js"></script>