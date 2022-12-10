            $(document).ready(function() {
                patientIdFetch()

            });

            function patientIdFetch() {
                $('#total').click(function() {
                    var patientid = $(this).val();
                    $.ajax({
                        url: previews, //send value to the preview function
                        type: 'GET',
                        data: {
                            patientid //send get request patient id to controler function
                        }
                    });
                    window.location.replace(billing);
                });

            }