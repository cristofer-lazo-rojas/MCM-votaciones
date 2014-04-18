function ValidatorAjaxForm(form) {
    var validate = false;
    //alert(form.attr('method')+' - '+form.attr('action')+' - '+form.serialize());
    form.bind("submit", function() {
        
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            beforeSend: function() {
                $(".before").append("<div class='load' ></div>");
            },
            complete: function(data) {

            },
            success: function(data) {
                $(".before").hide();
                if (data.success == false) {
                    for (datos in data.errors) {
                        $('#' + datos + '-error').html(data.errors[datos]);
                    }
                } else {
                    validate = true;
                    form.submit();
                }
            },
            error: function(errors) {
                $(".before").hide();
            }
        });
        return validate;
    });
}

function ValidatorAjaxInput(input, url, elementError) {
    
    input.bind('blur',function() {
        $.ajax({
            type: 'post',
            url: url,
            data: 'email='+input.val(),
            beforeSend: function() {
                elementError.addClass('load');
            },
            complete: function(data) {

            },
            success: function(data) {
                elementError.removeClass('load');
                if (data.success == false) {
                    input.removeClass('valid');                
                    input.addClass('error');
                    elementError.html('');
                    for (datos in data.errors) {
                        elementError.append(data.errors[datos]);
                    }
                }else{
                    elementError.html(data.message);
                }
            },
            error: function(errors) {
                elementError.removeClass('load');
            }
        });
    });
}