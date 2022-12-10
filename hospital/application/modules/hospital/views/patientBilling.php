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

<script>
    $(document).ready(function() {
        getTestPrice();
        getTestDiscountAmount();
        getTestNetTotal();
        getTestSubTotal();
    });

    function getTestPrice() {
        $.ajax({
            type: 'ajax',
            url: 'hospital/sumOfBillings', //url for getting encoded data from the controler and functin
            async: false,
            dataType: 'json',
            success: function(price) {
                var html = '';
                if (price) {
                    // alert(price.price);
                    // console.log(price.price);

                    html += '<input type="text" class="form-control input-sm" placeholder="NPR ' + price.price + ' " name="" readonly>';
                }
                $('.price').html(html);
            }

        });
    }

    function getTestNetTotal() {
        $.ajax({
            type: 'ajax',
            url: 'hospital/sumofNetTotal', //url for getting encoded data from the controler and functin
            async: false,
            dataType: 'json',
            success: function(nettotal) {
                var html = '';
                if (nettotal) {
                    html += '<input type="text" class="form-control input-sm" placeholder="NPR ' + nettotal.net_total + ' " name="" readonly>';
                }
                $('.nettotal').html(html);
            }

        });
    }

    function getTestDiscountAmount() {
        $.ajax({
            type: 'ajax',
            url: 'hospital/sumofDiscountAmount', //url for getting encoded data from the controler and functin
            async: false,
            dataType: 'json',
            success: function(discount) {
                var html = '';
                if (discount) {
                    html += '<input type="text" class="form-control input-sm" placeholder="NPR ' + discount.discount_amount + ' " name="" readonly>';
                }
                $('.discount').html(html);

            }

        });
    }

    function getTestSubTotal() {
        $.ajax({
            type: 'ajax',
            url: 'hospital/sumOfSubTotal', //url for getting encoded data from the controler and functin
            async: false,
            dataType: 'json',
            success: function(sub_total) {
                var html = '';
                if (sub_total) {
                    html += '<input type="text" class="form-control input-sm" placeholder="NPR ' + sub_total.subtotal + ' " name="" readonly>';
                }
                $('.subtotal').html(html);

            }

        });
    }
</script>