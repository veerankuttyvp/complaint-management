$(function(){
	
   $('#subdivisions_table').dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [1,2,3,4,5,6,7]}]}); 
   $("#phones_table").dataTable({"aoColumnDefs": [{"bSortable": false, "aTargets": [1,2,3,4,7]}]}); 
   var subdivision_id = "";
   $(".add_mobile_user").click(function(){
       var btn_loader = $(this).next();
       subdivision_id = $(this).attr("id");
       $.ajax({
           url : main_path + "mobile_users/getUnAssignedMobileUsers",
           type : "post",
           success : function(response){
               btn_loader.addClass("hide");
               $("#mobile_user_modal_span").html(response);
               $("#mobile_user_add_modal").modal("show");
               $("#mobile_users").chosen({width: "100%","placeholder_text_multiple":"Select Users"});
                initClickMobileUserAdd();
           },
           beforeSend: function(){
               btn_loader.removeClass("hide");
           }
        });
   }); 

    function initClickMobileUserAdd(){
        $(".add_mobile_user_button").click(function(){
            var Data = {};
            Data['mobile_users'] = $("#mobile_users").val();
            Data['subdivision_id'] = subdivision_id;
            Data['center_name'] = $('#center_name').val();
            var loader = $(this).next();
            $.ajax({
                url : main_path + "mobile_users/add_mobile_user",
                type : "post",
                data : Data,
                success : function(response){
                    alert(response);
                    loader.addClass("hide");
                    $("#mobile_user_add_modal").modal("hide");
                    window.location = main_path + "subdivisions/view/"+subdivision_id;
                },
                beforeSend : function(){
                  loader.removeClass("hide");  
                } 
            });
       });
    }
   
   $(".view_mobile_detail").click(function(){
        var user_id = $(this).parents("tr").children().eq(0).html();
        var loader = $(this).prev();
        $.ajax({
           url : main_path + "mobile_users/mobile_detail/"+user_id,
           type : "post",
           success : function(response){
               loader.addClass("hide");
               $("#mobilephone_detail_span").html(response);
               $("#mobile_details_modal").modal("show");
           },
           beforeSend : function(){
               loader.removeClass("hide");
           }
        });
   });
   
});