@extends('layouts.master')

@section('estilos')
<style>
    ul.candidatos {
        list-style: none;
        padding: 0;
        margin: 0 auto;
        width: 42em;
        height: 24em;
    }
    ul.candidatos li {
        height: 20em;
        width: 30em;
        background-color: #ccc;
        text-align: center;
        cursor: pointer;
        padding: 10px;
    }
    ul.candidatos li.roundabout-in-focus {
        cursor: pointer;
    }
    ul.candidatos li span {
        display: block;
    }
    ul.candidatos li img {
        height: 12em;
        margin: 0 auto;
    }
    ul.candidatos li h2 {
        padding-top: 2px;
        padding-bottom: 2px;
        margin: 0px;
        text-align: center;
        font-size: 16px;
    }
    .monolith {
        background-color: #222;
        color: #fff;
        text-align: center;
        width: 300px;
        height: 400px;
        position: absolute;
        z-index: 260;
        left: 135px;
        border-color: #222;
        opacity: 0.6;
    }

    #carbonads-container {
        clear: both;
        margin-top: 1em;
    }
    #carbonads-container .carbonad {
        margin: 0 auto;
    }
</style>
@stop

@section('scripts')
{{HTML::script("recursos/cj/fredhq-roundabout/js/jquery.roundabout.js")}}
@stop

@section('nav')
{{ isset($nav) ? $nav : '' }}
@stop

@section('content')  

<div>
    <h1>{{ $viewEvento->v_evento_titulo }}</h1>
    <h4>{{ HTML::link("#".$viewEvento->i_categoria_id, $viewEvento->v_categoria_descripcion, array("id" => "link", "class" => "radius button right", "style" => "margin-bottom: 0;"))}}</h4>
    {{HTML::link("/", "Eventos", array("id" => "link", "class" => "radius button right", "style" => "margin-bottom: 0;"))}}

    <p>{{ $viewEvento->v_evento_descripcion }}</p><br>

    <div style="width: 100%;">
        <ul class="candidatos">
            @foreach($candidatos as $candidato)
            <li class="mover">
                <?php echo HTML::image("archivos/img/eventos/" . $candidato->v_candidato_ruta_imagen, $candidato->v_candidato_nombre, array('title' => $candidato->v_candidato_nombre)) ?>                   
                <span>
                    <hgroup> <h2>{{$candidato->v_candidato_nombre}}</h2> </hgroup>
                    @if(!$votoClausurado)
                    <?php
                    echo Form::Open(array('route' => 'votarEvento', 'files' => true, 'onsubmit' => 'return formvotar' . $candidato->i_candidato_id . '()'));
                    echo Form::hidden("id_evento", $viewEvento->i_evento_id);
                    echo Form::hidden("id_candidato", $candidato->i_candidato_id);
                    echo Form::submit('Votar', array("class" => "radius tiny small button btn btn-primary", "type" => "submit", 'id' => 'votar-' . $candidato->i_candidato_id, "style" => "margin-bottom: 0;"));
                    echo Form::close();
                    ?>
                    @endif
                    <script type="text/javascript"><?php echo "function formvotar" . $candidato->i_candidato_id . "(){" . "votar = confirm('Estas seguro de realizar tu voto por este candidato');" . "if(votar)return true;return false;" . "}" ?></script>
                </span>
            </li>
            @endforeach
        </ul>

        <?php if ($mensaje != "") { ?>
            <script>
                alert('<?php echo $mensaje; ?>');
            </script>
        <?php } ?>

    </div>
    <script>
        $(document).ready(function() {
            $('ul.candidatos').roundabout({
                minZ: 100,
                maxZ: 400,
                minOpacity: 0.7,
                minScale: 0.5,
                childSelector: '.mover',
                tilt: -5
            });
        });
    </script>
    <div style="width: 100%">
        <strong>Inició: <date>{{ $viewEvento->d_evento_inicio }}</date> </strong>
        <strong>Termina: <date>{{ $viewEvento->d_evento_fin }}</date> </strong>
        {{HTML::link("#".$viewEvento->i_usuario_id, $viewEvento->v_usuario_nombre.' '.$viewEvento->v_usuario_apellidos, array("id" => "link", "class" => "radius button right", "style" => "margin-bottom: 0;"))}}
    </div>


    <br/>
    <!--
    <div style="position: absolute; float:right; " >
        <iframe src="http://localhost:3000/sala?id={{ $viewEvento->i_usuario_id }}&u={{ Session::get('usuario.id') }}" style="border: 0; width: 300px; height: 500px;" />
    </div>
    -->
    {{HTML::style("recursos/css/client-socket.io.css")}}
    {{HTML::style("recursos/cj/chat-deploy/chat-deploy-bottom.css")}}
    {{HTML::script("recursos/cj/chat-deploy/chat-deploy-bottom.js")}}
    <div class="cjContentChat" id="contentChat">
        <div class="cjChatHeader">
            <div class="cjChatEventHide">SALA DE CHAT</div>
        </div>
        <section id="contentMensajesChat" class="cjChatBody"></section>
        <div class="input-group" style="padding-right:0px;">
            <textarea id="sendMensajeChat" class="form-control" rows="2"></textarea>
            <span class="input-group-addon">&#187;</span>
        </div>
    </div>  
    <div class="cjChatTab">
        <div class="cjChatEventShow">SALA DE CHAT</div>
    </div>


    <div id="temporal-chat">         
        {{HTML::script("recursos/ajax/ajax-select.js")}}
        <?php $url = Request::url() . '/../../../ajaxSelect/mensajes'; ?>        
        <script type="text/javascript">
            var urlLoadMsg = '<?php echo $url ?>';
            var room = <?php echo $viewEvento->i_evento_id; ?>;
            var userId = <?php echo Session::get('usuario.id'); ?>;
            var _tockenChat = '<?php echo $_SERVER['REMOTE_ADDR']; ?>';

            jQuery(document).ready(function($) {
                var contentChat = $('#contentChat');
                var contentMsgChat = $('#contentMensajesChat');
                var selectAjaxMensajesChat = new SelectAjaxMensajesChat(room, userId, urlLoadMsg, contentChat, contentMsgChat);
                //$('#temporal-chat').html("hola mundo");
            });
        </script>        
    </div>

    <script src="http://localhost:3000/socket.io/socket.io.js"></script>

    <script>
        if (_tockenChat && room && userId) {
            var socket = io.connect('http://localhost:3000'); //'http://127.0.0.1:3000/'                
            //console.log(socket.socket);
            socket.on('connect', function() {
                socket.emit('room', {
                    _tocken: _tockenChat,
                    room: room,
                    userId: userId
                });
            });

            socket.on('msg', function(data) {
                //console.log('Incoming message:', data.msg);
                data.avatar = 'http://localhost:3000/images/avatar.png';
                if (data.avatar) {
                    avatar = data.avatar;
                }
                $('#contentMensajesChat').append($('<div class="alert alert-info">').append($('<img class="avatar" src="' + avatar + '" alt="' + data.nombre + '">')).append($('<a href="#' + data.userId + '" class="alert-link">').text(data.nombre + ' ')).append($('<small style="color:#8899A6;">').text(data.date)).append('<br/>').append(data.msg));
                $('#contentMensajesChat').scrollTop($("#contentMensajesChat")[0].scrollHeight);
            });

            $('#sendMensajeChat').keyup(function(e) {
                if (e.keyCode == 13) {
                    msg = $('#sendMensajeChat').val().trim();
                    $('#sendMensajeChat').val("");

                    if (msg) {
                        d = new Date();
                        date = d.getFullYear() + '-' + d.getMonth() + '-' + d.getDay() + ' ' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds();
                        //console.log(date+': '+msg);
                        socket.emit('prueba', {
                            room: room,
                            userId: userId,
                            date: date,
                            msg: msg
                        });
                    }
                }
            });
        }
    </script>

</div>

{{-- This comment will not be in the rendered HTML --}}
@stop