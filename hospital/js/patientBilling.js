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