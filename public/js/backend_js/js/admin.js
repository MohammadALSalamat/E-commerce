$(function() {

    // call the selectBoxIt method on our HTML

    $('select').selectBoxIt({

    }); // basic use





    // hide placeholder when we do focus
    $('[placeholder]').focus(function() { // get the attribute placeholder
        $(this).attr('data-text', $(this).attr('placeholder')); // if the placeholder is focus
        $(this).attr('placeholder', ' '); // hide the place holder
    }).blur(function() { // if no focus
        $(this).attr('placeholder', $(this).attr('data-text')) // get data back if no focus
    });

    // add star on requird fields to make them unik
    $('input').each(function() {
        if ($(this).attr('required') === 'required') {
            $(this).after('<span class = "star"> * </span>')
        }
    });
    //convert password field to text when hover
    let $pass_val = $('.Password')
    $('.show-pass').hover(function() {

        $pass_val.attr('type', 'text')
    }, function() {
        $pass_val.attr('type', 'password')
    });


    // Dashboard //
    $('.toggle-info').click(function() {
        $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(200);
        if ($(this).hasClass('selected')) {
            $(this).html('<i class = " fa fa-minus fa-md" > </i>')
        } else {
            $(this).html('<i class = " fa fa-plus fa-md" > </i>')

        }



    });





    // confirm for delete

    $('.confirm').click(function() {
        return confirm('Are you sure About deleting this record ?');
    });

    //category view options

    $('.main-Cat h3').click(function() {
        $(this).next('.full-view').fadeToggle(100);
        $(this).css('margin-bottom', '20px')

    });
    // this function is work the same as above to show The category or hidden it
    $('.option span').click(function() {

        $(this).addClass('active').siblings('span').removeClass('active');
        if ($(this).data('view') === 'full') {
            $('.main-Cat .full-view').fadeIn(200);
        } else {
            $('.main-Cat .full-view').fadeOut(200);
            $('.main-Cat h3').css('margin-bottom', '20px')
        }

    });
});