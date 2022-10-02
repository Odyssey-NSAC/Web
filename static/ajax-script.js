$(document).on('submit','#uploadFile',function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
            method:"POST",
            url: "backend-script.php",
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
      beforeSend:function(){
            $('button[type="submit"]').attr('disabled','disabled');
      },
        success: function(data){
       
        $('button[type="submit"]').removeAttr('disabled');
       
         $('#alertBox').html(data).fadeIn();
      }
           
});
});