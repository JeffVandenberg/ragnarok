$.fn.classList = function() {
    return $(this).attr('class').split(/\s+/);
};

$(function() {
    if(typeof $(document).foundation != 'undefined') {
        $(document).foundation();
    }

    $('input.required').each(function() {
        $(this).closest('div').addClass('required');
        $(this).attr('required', 'required');
    });

    $(document)
        .on('focus', '.field-hint', function () {
            if ($(this).val() == $(this).attr('fieldname')) {
                $(this).val('').css('color', '#000000');
            }
        })
        .on('blur', '.field-hint', function () {
            if ($.trim($(this).val()) == '') {
                $(this).val($(this).attr('fieldname')).css('color', '#aaaaaa');
            }
            else {
                $(this).css('color', '#000000');
            }
        });

});

jQuery.fn.getValue = function() {
    if($(this).hasClass('field-hint')) {
        if($(this).val() === $(this).attr('fieldname')) {
            return '';
        }
        else {
            return $(this).val();
        }
    }
    else {
        return $(this).val();
    }
};

var baseUrl = '/';