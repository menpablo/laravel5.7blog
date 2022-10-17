(function ($, undefined) {
    'use strict';

    let blogs = {};
    blogs.delete = function(e){
        e.preventDefault() 
        if (confirm('Are you sure?')) {
            e.currentTarget.form.submit() 
        }
    }

    $('.blog_delete_btn').on('click',blogs.delete );
    
})(jQuery);
