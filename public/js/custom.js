$(document).ready(function () {

    $(".myBtn").click(function(){
      if($(".myBtn").text()=="Check Out")
      {

       // alert("12345");
        var textarea = '<textarea name="description" id="description" rows="4" cols="75"  ></textarea>';
        console.log(textarea);
        $(".modal-header").html("Do You Want to Check Out");
        $(".modal-body").show();
        $(".modal-body").html(textarea);
         $("#MyPopup").modal("show");
      }
      else
      {
         $(".modal-header").html("Do You Want to Check In");
         $(".modal-body").hide();
         $("#MyPopup").modal("show");
      }

     
      
    });
    $('.no-btn').click(function(){
      $("#MyPopup").modal("hide");
    });
    $('.yes-btn').click(function(){
      if($(".myBtn").text()=="Check In")
      {
         $(".myBtn").text('Check Out');
         $("#MyPopup").modal("hide");
          $.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
          },
      });
     //var description = $('#description').val();
    
      $.ajax({
        url:'ajax/checkintime',
        method: 'POST',
        //data: {description:description},
        dataType: 'json/application',
        success: function(response){
            console.log("saddique");
        },
        error: function(error)
        {
          console.log(error);
        }
     });
      }
      else
      {
        $(".myBtn").text('Check In');
         $("#MyPopup").modal("hide");
                $.ajaxSetup({
    beforeSend: function(xhr, type) {
        if (!type.crossDomain) {
            xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
          },
      });
     var description = $('#description').val();
   
      $.ajax({
        url:'ajax/checkouttime/',
        method: 'POST',
        data: {description:description},
        dataType: 'json/application',
        success: function(response){
            console.log("saddique");
        },
        error: function(error)
        {
          console.log(error);
        }
     });
      }  
    
    
    });

});