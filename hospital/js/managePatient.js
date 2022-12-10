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
                url: previews,//send value to the preview function
                type: 'GET',
                data: {
                    patientid //send get request patient id to controler function
                },  
                success:function(data) {
                    window.location.replace(billing);//refresh the page to billing view
                }
               
            });
        });
    }

    function preview() { 
        $("button:first-child").click(function(){
           var patientid = $(this).val();//first button to be selected and generate patient id
            $.ajax({
                url: previews,//send get request to the function
                type: 'GET',
                data: {
                    patientid // sending patentid to preview Page
                },  
                success:function(data) {
                    window.location.replace(previewdata); //replace the function
                }
               
            });
            
        });
     }