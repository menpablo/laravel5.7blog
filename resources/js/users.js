var form = "role_combo";
(function ($, undefined) {
    'use strict';

    let usersForm = {};
    usersForm.showHideSupervisor = function(e){
       // e.preventDefault();
        if($("#user_type").val() == 2){
            $('#supervisor_div').css("display", "");
        }else{
            $('#supervisor_div').css("display", "none");
        }
    };
    usersForm.showHideSupervisor();

    //binding
    $("#user_type").on('change',usersForm.showHideSupervisor);
    //$("#accept").on('click',integrate.save);
})(jQuery);
