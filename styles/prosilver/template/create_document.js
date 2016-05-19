$(document).ready(function() {
    $("#submit").click(function() {
        var error = new Array();
        var title = $("#title").val();
        var complete = $("#complete:checked").length;
        var authors = $("#authors").val();
        var categories = $(".category_checkbox:checked").map(function(_, el) {
            var t = $(el).attr("id");
            var i = t.indexOf("_") + 1;
            return t.substring(i);
        }).get();
        var chapter_title = $("#chapter_title").val();
        tinymce.triggerSave();
        var text = $("#document_text").val();
        /*console.log(title);
        console.log(complete);
        console.log(authors);
        console.log(categories);
        console.log(chapter_title);
        console.log(text);*/
        
        if(title.length == 0) {
            error.push(lang_array.ERROR_FORM_EMPTY_TITLE);
            $("#title").animate( 
                {
                    backgroundColor: "#ffcccc",
                    
                }, 
                500,
                function() {
                    //console.log("AAA");
                }
            );
        }
        
        if(authors == null) {
            error.push(lang_array.ERROR_FORM_EMPTY_AUTHORS);
            $("#authors").animate( 
                {
                    backgroundColor: "#ffcccc",
                    
                }, 
                500,
                function() {
                    //console.log("AAA");
                }
            );
        }
        
        if(!categories.length) {
            error.push(lang_array.ERROR_FORM_EMPTY_CATEGORIES);
            $("#category_widget").animate( 
                {
                    backgroundColor: "#ffcccc",
                    
                }, 
                500,
                function() {
                    //console.log("AAA");
                }
            );
        }
        
        /*if(chapter_title == "") {
            error.push("chapter_title");
            $("#chapter_title").animate( 
                {
                    backgroundColor: "#ffcccc",
                    
                }, 
                500,
                function() {
                    //console.log("AAA");
                }
            );
        }*/
        
        if(text == "") {
            error.push(lang_array.ERROR_FORM_EMPTY_TEXT);
            $("#chapter_text").animate( 
                {
                    backgroundColor: "#ffcccc",
                    
                }, 
                500,
                function() {
                    //console.log("AAA");
                }
            );
        }
        
        if(error.length) {
            console.log("ERROR: " + error.join(" - "));
            
            var dialog_text = lang_array.ERROR_FORM_EMPTY_MAIN.format(error.join("</li><li>"));
            console.log(dialog_text);
            $("#modal_text").html(dialog_text);
            $("#modal_dialog").dialog({
                resizable:false,
                minHeight: 140,
                minWidth: 200,
                width: 500,
                modal: true,
                title: lang_array.DIALOG_TITLE_ERROR_INVALID_FORM_SUBMISSION,

                buttons: {
                    Ok: function() {
                        $(this).dialog("close");
                    }
                }
            });
        } else {
            // Submit the form via jquery ajax
            
            // Build query string
            var qString = new String();
            qString += "title=" + title;
            qString += "&complete=" + complete;
            qString += "&authors=" + authors.join(",");
            qString += "&categories=" + categories.join(",");
            qString += "&chapter_title=" + chapter_title;
            qString += "&text=" + text;
            
            //console.log(qString);
            
            encodeURI(qString);
            
            $.post(CREATE_DOCUMENT_AJAX_URL,
                {
                    title: encodeURI(title),
                    complete: complete,
                    authors: encodeURI(authors.join(",")),
                    categories: encodeURI(categories.join(",")),
                    chapter_title: encodeURI(chapter_title),
                    text: encodeURI(text)
                },
                function(data, status) {
                    console.log(data);
                    console.log(status);
                }
            );
        }
    });
});
