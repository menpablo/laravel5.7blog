(function ($, undefined) {
    'use strict';

    let blogs = {};
    blogs.search = function(e){
        e.preventDefault() ;
        let searchVal = $('#search_input').val();
        if(searchVal.length < 3){
            alert('Search terms must be at least 3 characters in length');
            return;
        }
        window.location.href = 'blogs?search='+searchVal;
    }

    blogs.delete = function(e){
        e.preventDefault() 
        if (confirm('Are you sure?')) {
            e.currentTarget.form.submit() 
        }
    }

    $('.blog_delete_btn').on('click',blogs.delete );
    $('#search_btn').on('click', blogs.search);
})(jQuery);
