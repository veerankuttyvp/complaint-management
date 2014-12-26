$(function(){
    $('#category_tree').jstree({
        "core" : {
            "check_callback" : true,
            "themes" : {
                 "variant" : "large",
                 "icons" : false
            }
        },
        "contextmenu": {items: customMenu},
        "types" : {
            "default" : {
                "icon" : "gi gi-ok_2"
            }
        },
        "plugins" : [
            "state", "wholerow", "contextmenu", "types"
        ]
    }).on('create_node.jstree', function (e, data) {
        console.log("create");
        insertNode(data);
    }).on('rename_node.jstree', function (e, data) {
        console.log("rename");
        renameNode(data);
    }).on('delete_node.jstree', function (e, data) {
        console.log("delete");
        deleteNode(data);
    }); 
    function customMenu(node) {
        // The default set of all items
        var items = {
            addItem:{
                label: "Create",
                action: function () {updateCategoryTree("add");},
                icon : "gi gi-circle_plus"
            },
            renameItem: { // The "rename" menu item
                label: "Rename",
                action: function () {updateCategoryTree("rename");},
                icon : "gi gi-circle_info"
            },
            deleteItem: { // The "delete" menu item
                label: "Delete",
                action: function () {updateCategoryTree("delete");},
                icon: "gi gi-circle_remove"
            }
        };
        return items;
    }
  
    $("#create_category").click(function(){
        updateCategoryTree("add"); 
    });
    $("#rename_category").click(function(){
        updateCategoryTree("rename");
    });
    $("#delete_category").click(function(){
        updateCategoryTree("delete");
    });
    
    function updateCategoryTree(type){
        switch(type){
            case "add":
                var ref = $('#category_tree').jstree(true);
                var sel = ref.get_selected();
                if(!sel.length) { return false; }
                sel = sel[0];
                sel = ref.create_node(sel, {"type":"default"});
                if(sel) {
                    ref.edit(sel);
                }
                break;
            case "rename":
                var ref = $('#category_tree').jstree(true);
                var sel = ref.get_selected();
                if(!sel.length) { return false; }
                sel = sel[0];
                ref.edit(sel);
                break;
            case "delete":
                var ref = $('#category_tree').jstree(true);
                var sel = ref.get_selected();
                if(!sel.length) { return false; }
                ref.delete_node(sel);
                break;
        }
    }
    
    function insertNode(data){
        var Data = {};
        Data['parent'] = data.node.parent;
        Data['name'] = data.node.text;
        $.ajax({
            url : main_path + "categories/add",
            type : "Post",
            data : Data,
            success : function(response){
                $("#"+data.node.parent).children().eq(2).children().eq(1).remove();
                data.instance.set_id(data.node, response);
            },
            beforeSend : function(){
                $("#"+data.node.parent).children().eq(2).append("<i class='loader-03'></i>");
            }
        });
    }
    
    function deleteNode(data){
        var Data = {};
        Data['id'] = data.node.id;
        $.ajax({
            url : main_path + "categories/remove",
            type : "Post",
            data : Data,
            success : function(response){
                if(response === "true"){
                    $("#"+data.node.parent).children().eq(2).children().eq(1).remove();
                }
            },
            beforeSend : function(){
                $("#"+data.node.parent).children().eq(2).append("<i class='loader-03'></i>");
            }
        });
    }
    
    function renameNode(data){
        var Data = {};
        Data['name'] = data.node.text;
        Data['id'] = data.node.id;
        $.ajax({
            url : main_path + "categories/rename",
            type : "Post",
            data : Data,
            success : function(response){
                $("#"+data.node.id).children().eq(2).children().eq(1).remove();
            },
            beforeSend : function(){
                $("#"+data.node.id).children().eq(2).append("<i class='loader-03'></i>");
            }
        });
    }
    
});