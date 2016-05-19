$(document).ready(function() {


    $.ajax({
        url: EXTENSION_PATH_LANG,
        success: function(data) {
            lang_array = data; 

        },
        async: false,
        dataType: 'JSON'
    });
        
    console.log(lang_array);
    
    
    String.prototype.format = function() {
        var str = this;
        for (var i = 0; i < arguments.length; i++) {       
          var reg = new RegExp("\\{" + i + "\\}", "gm");             
          str = str.replace(reg, arguments[i]);
        }
        return str;
      }
});

