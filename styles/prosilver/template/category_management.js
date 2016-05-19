

$(document).ready(function() {
    //$(".sub_category").slideUp();
    var expand_init = $("#init_expand").val();
    if(expand_init) {
        $(".root_category").find("ul").hide();
        $(".root_category").find(".expand_button").html("+");
    }
    $(".expand_button").click(function() {
        if($(this).html() == "+") {
            $(this).html("-");
        } else {
            $(this).html("+");
        }
        $(this).siblings("ul").slideToggle("slow");
    });
    
    $(":checkbox").change(function() {
        var children = $(this).siblings(".sub_category");
        var checked = $(this).prop("checked");
        if(children.length) {
            $(children).find(":checkbox").prop("checked", checked);
        }
        if(!checked) {
            
            $(this).parents().children("input").prop("checked", false);
        }
    });
    
    $(".category_management_tools_add").click(function() {
        // Replace the '+' sign with an input box for the new category's name.
        $("#input_add_category").remove();
        var dAddCategoryContainer = document.createElement("div");
        $(dAddCategoryContainer).attr("id", "input_add_category");
        
        var iAddInput = document.createElement("input");
        
        $(iAddInput).addClass("input_add_category_title")
                .attr({
            type: "text"
        });
        
        
        $(dAddCategoryContainer).append(iAddInput);
        $(iAddInput).focus();
        
        var iAddInput = document.createElement("input");
        
        $(iAddInput).addClass("input_add_category_selectable")
                .attr({
            type: "checkbox"
        });
        
        
        $(dAddCategoryContainer).append(iAddInput);
        $(iAddInput).focus();
        
        var bOk = document.createElement("span");
        $(bOk).addClass("category_add_tick");
        bOk.innerHTML = "&check;";
        
        $(bOk).on("click", function(e){
            // Catch the enter button
               
                var parent_id = $("#input_add_category").parent().attr("id");
                parent_id = parent_id.substr(parent_id.indexOf("_") + 1);
                var category_title = $(".input_add_category_title").val();
                var category_selectable = $(".input_add_category_selectable").is(':checked') ? 1 : 0;
                //console.log(parent_id);
                //console.log(category_title);
                //console.log(category_selectable);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if(xhttp.readyState == 4 && xhttp.status == 200) {
                        //console.log(xhttp.responseText);
                        var rjson = jQuery.parseJSON(xhttp.responseText);
                        if(rjson.response == 1) {
                            $("#input_add_category").remove();
                            
                            var li = document.createElement("li");
                            $(li).attr("id", "category_" + rjson.category_id);
                            
                            var rt = document.createElement("span");
                            $(rt).attr("id", rjson.category_id);
                            $(rt).addClass("category_management_tools_remove");
                            rt.innerHTML = "-";
                            $(rt).appendTo(li);
                            
                            var eb = document.createElement("span");
                            $(eb).addClass("expand_button");
                            $(eb).attr("id", "expand_category_" + rjson.category_parent);
                            $(eb).html("-");
                            $(eb).prependTo($("#category_" + rjson.category_parent));
                            
                            var cb = document.createElement("input");
                            $(cb).attr({
                                "type":"checkbox",
                                "id":"category_" + rjson.category_id,
                                "name":"categories"
                            });
                            $(cb).appendTo(li);
                            
                            var ct = document.createElement("span");
                            $(ct).addClass("category_selectable");
                            ct.innerHTML = rjson.category_title;
                            $(ct).appendTo(li);
                            
                            var at = document.createElement("span");
                            $(at).attr("id", rjson.category_id);
                            $(at).addClass("category_management_tools_add");
                            at.innerHTML = "+";
                            $(at).appendTo(li);
                            if(!$("#category_" + rjson.category_parent).children(".sub_category").length) {
                                var sc = document.createElement("ul");
                                $(sc).addClass("sub_category");
                                $(sc).appendTo($("#category_" + rjson.category_parent));
                            }
                            $("#category_" + rjson.category_parent).children(".sub_category").append(li);
                        }
                    }
                    
                }
                //console.log(EXTENSION_PATH_ADD + "?category_parent=" + parent_id + "&category_title=" + category_title + "&category_selectable=" + category_selectable);
                xhttp.open("GET", EXTENSION_PATH_ADD + "?category_parent=" + parent_id + "&category_title=" + category_title, true);
                xhttp.send();
            
        });
        $(dAddCategoryContainer).append(bOk);
        
        $(this).parent().append(dAddCategoryContainer);
    });
    
    
        
    $(".category_management_tools_remove").click(function(){
        var category_id = $(this).attr("id");
        var category_title = $(this).siblings("#category_title").html();
        //console.log(MODAL_TEXT_CAT_DELETE); 
        //console.log(MODAL_TEXT_CAT_DELETE.format(category_title)); 
        $("#modal_text").html(MODAL_TEXT_CAT_DELETE.format(category_title));
        $("#modal_dialog").dialog({
            resizable:false,
            minHeight: 140,
            minWidth: 200,
            modal: true,
            title: "Delete category",
            
            buttons: {
                Delete: function() {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if(xhttp.readyState == 4 && xhttp.status == 200) {
                            //console.log(xhttp.responseText);
                            var rjson = jQuery.parseJSON(xhttp.responseText);
                            //console.log(rjson);
                            if(rjson.response == 1) {
                                //console.log("Removing " + rjson.category_title);
                                $("#category_" + rjson.category_id).remove();
                                //console.log($("#category_" + rjson.category_parent).children("ul"));
                                if(!$("#category_" + rjson.category_parent).children("ul").children().length) {
                                    $("#category_" + rjson.category_parent).children("ul").remove();
                                    $("#category_" + rjson.category_parent).children(".expand_button").remove();
                                }
                            }
                            
                        }

                    }
                    //console.log(EXTENSION_PATH_DELETE + "?category_id=" + category_id);
                    xhttp.open("GET", EXTENSION_PATH_DELETE + "?category_id=" + category_id, true);
                    xhttp.send();
                    $(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            }
        });
    }); 
    
    
});
