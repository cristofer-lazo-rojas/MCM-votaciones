function SelectAjaxMensajesChat(eventId, userId, url, contentChat, contentMsgChat) {    
        //alert('eventId='+eventId+'&userId='+userId);
        $.ajax({
            type: 'post',
            url: url,
            data: 'eventId='+eventId+'&userId='+userId,
            beforeSend: function() {
                contentChat.addClass('load');
            },
            complete: function(data) {

            },
            success: function(data) {
                contentChat.removeClass('load');
                if (data.success == false) {
                    contentChat.addClass('error-load-chat');
                    contentChat.html('');
                    for (datos in data.errors) {
                        console.log(data.errors[datos]);                        
                        contentChat.append(data.errors[datos]);
                    }
                }else{
                    var dim = data.mensaje.length;
                    var msg = data.mensaje;
                    for (var i = 0; i < dim; i++) {
                        viewmsg=msg[i];
                        avatar = 'http://localhost:3000/images/avatar.png';
                        if (viewmsg.avatar) {
                            avatar = viewmsg.avatar;
                        }
                        contentMsgChat.prepend($('<div class="alert alert-info">').append($('<img class="avatar" src="' + avatar + '" alt="'+viewmsg.editor+'">')).append($('<a href="#' + viewmsg.userId + '" class="alert-link">').text(viewmsg.editor + ' ')).append($('<small style="color:#8899A6;">').text(viewmsg.fecha)).append('<br/>').append(viewmsg.msg));         
                        contentMsgChat.scrollTop(contentMsgChat[0].scrollHeight);
                    }                    
                }
                console.log(data);
                
            },
            error: function(errors) {
                contentChat.removeClass('load');
            }
        });
}