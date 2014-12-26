$(function(){
      var subdivision_id = "";

  $(".change_user").click(function(){
        var user_id = $(this).attr("user_id");
        // alert(user_id);
        // var loader = $(this).prev();
        subdivision_id = $(this).attr("suid");
        center_id = $(this).attr("center_id");
       $.ajax({
           url : main_path + "mobile_users/user_change/"+user_id,
           type : "post",
           data:{center_id:center_id,subdivision_id:subdivision_id},
           success : function(response){
               // // loader.addClass("hide");
               // $("#mobilephone_detail_span").html(response);
               // $("#mobile_details_modal").modal("show");
               $("#mobile_user_modal_span").html(response);
               $("#mobile_user_add_modal").modal("show");
               $("#mobile_users").chosen({width: "100%","placeholder_text_multiple":"Select Users"});
           },
           beforeSend : function(){
               // loader.removeClass("hide");
           }
        });
   });




  
  $(".change_mobile_detail").click(function(){
          var user_id = $(this).parents("tr").children().eq(0).html();
          var loader = $(this).prev();
          var action = 'update';
          $.ajax({
             url : main_path + "mobile_users/mobile_detail/"+user_id+"/"+action,
             type : "post",
             success : function(response){
                 //loader.addClass("hide");
                 $("#mobilephone_detail_span").html(response);
                 $("#mobile_details_modal").modal("show");
             },
             beforeSend : function(){
                 loader.removeClass("hide");
             }
          });
     });
});