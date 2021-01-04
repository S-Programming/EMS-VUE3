$(document).ready(function () {

    $(".myBtn").click(function(){
      if($(".myBtn").text()=="Check Out")
      {

        var textarea = '<textarea name="abc" rows="4" cols="75"  ></textarea>';
        console.log(textarea);
        $(".modal-body").html(textarea);
      }

      $("#MyPopup").modal("show");
    });
    $('.coci-btn').click(function(){
      /*if($(".myBtn").text()=="Check In")
      {
         $(".myBtn").text('Check Out');
         $("#MyPopup").modal("hide");
      }
      else
      {
        $(".myBtn").text('Check In');
         $("#MyPopup").modal("hide");
      }  */
     
        var url = 'checkintime';
         var type = "POST";
      $.ajax({
            type: 'POST',
            url: "checkintime",
            
            success: function (data) {
               console.log(data);
            },
            error: function (data) {
                console.log(data);
            }
        });
    
});
});