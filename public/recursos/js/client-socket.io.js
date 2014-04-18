function clientSocket(_tokenChat, room, userId) {
    this._tokenChat=_tokenChat, this.room=room, this.userId=userId;
    if (this._tokenChat && this.room && this.userId) {
        var socket = io.connect('http://127.0.0.1:3000'); //'http://127.0.0.1:3000/'
        //console.log(socket);
        socket.on('connect', function() {
            socket.emit('room', {
                _tocken: this._tokenChat,
                room: this.room,
                userId: this.userId
            });
        });

        socket.on('msg', function(data) {
            //console.log('Incoming message:', data.msg);
            data.avatar = 'http://localhost:3000/images/avatar.png';
            if (data.avatar) {
                avatar = data.avatar;
            }
            $('#contentMensajesChat').prepend($('<div class="alert alert-info">').append($('<img class="avatar" src="' + avatar + '" alt="' + data.nombre + '">')).append($('<a href="#' + data.userId + '" class="alert-link">').text(data.nombre + ' ')).append($('<small style="color:#8899A6;">').text(data.date)).append('<br/>').append(data.msg));
        });

        $('#sendMensajeChat').keyup(function(e) {
            if (e.keyCode == 13) {
                msg = $('#sendMensajeChat').val().trim();
                $('#sendMensajeChat').val("");
                if (msg) {
                    d = new Date();
                    date = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDay() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();

                    socket.emit('prueba', {
                        room: this.room,
                        userId: this.userId,
                        date: date,
                        msg: msg
                    });
                }
            }
        });
    }
}