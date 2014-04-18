{{Form::open(array('route' => 'logout'))}}
{{Form::submit("cerrar Sesión",array("class"=>"button expand"))}}
{{Form::close()}}

<?php
$page = isset($filter['page']) ? $filter['page'] : '';
$idCategoria = isset($filter['idCategoria']) ? $filter['idCategoria'] : '';
$dateIniEvento = isset($filter['dateIniEvento']) ? $filter['dateIniEvento'] : '';
$privacidadEvento = (isset($filter['privacidadEvento']) and !empty($filter['privacidadEvento'])) ? $filter['privacidadEvento'] : '';
$tituloEvento = isset($filter['tituloEvento']) ? $filter['tituloEvento'] : '';
?>

<script type="text/javascript">

    function ajaxFilterEvent() {
        idCategoria = $('#filter-idCategoria').val();
        dateIniEvento = $('#filter-dateIniEvento').val();
        privacidadEvento = $('#filter-privacidadEvento').val();
        tituloEvento = $('#filter-tituloEvento').val();
        //alert(idCategoria+' '+dateIniEvento+' '+privacidadEvento+' '+tituloEvento);
        $.ajax({
            url: "eventos",
            data: {
                idCategoria: idCategoria,
                dateIniEvento: dateIniEvento,
                privacidadEvento: privacidadEvento,
                tituloEvento: tituloEvento
            },
            success: function(data) {
                $("#weather-temp").html("<strong>" + data + "</strong> degrees");
            }
        });
        return true;
    }
</script>
<h1>Listado de Eventos</h1>


<ul class="filtros">

    {{ Form::open(array('url' => 'eventos', 'method' => 'POST', 'onsubmit'=>'return ajaxFilterEvent()')) }}
    <input type="hidden" name="page" value="{{ $page }}"/>
    <li>
        <select name="idCategoria" id="filter-idCategoria" placeholder="Seleccione una categoria" >
            <option value="" >-- todas las categorias --</option>            
            @foreach ($categorias as $categoria)
            <?php
            $selected = "";
            if ($categoria->i_categoria_id == $idCategoria)
                $selected = "selected";
            ?>
            <option value="{{ $categoria->i_categoria_id }}" <?php echo $selected ?> >{{ $categoria->v_categoria_descripcion }}</option>
            @endforeach
        </select>
    </li>
    <li>
        <input name="dateIniEvento" id="filter-dateIniEvento" type="date" value="{{ $dateIniEvento }}" placeholder="Fecha de inicio">
    </li>  
    <li>
        <?php
        $todos = false;
        $publico = false;
        $privado = false;
        switch ($privacidadEvento) {
            case '1': $publico = true;
                break;
            case '2': $privado = true;
                break;
            default : $todos = true;
                break;
        }
        ?>
        todos {{ Form::radio('privacidadEvento', '', $todos, array('onclick'=>'editFilterPrivacidadEvento(\'\')')); }}
        públicos {{ Form::radio('privacidadEvento', '1', $publico, array('onclick'=>'editFilterPrivacidadEvento(1)')); }}
        privados {{ Form::radio('privacidadEvento', '2', $privado, array('onclick'=>'editFilterPrivacidadEvento(2)')); }}
        <script>
            function editFilterPrivacidadEvento(val) {
                document.getElementById('filter-privacidadEvento').value = val;
            }
        </script>
        <input type="hidden" value="{{ $privacidadEvento }}" id="filter-privacidadEvento"/>
    </li>
    <li>
        {{ Form::text('tituloEvento', $tituloEvento, array('placeholder' => 'Titulo del evento', 'id'=>'filter-tituloEvento')) }}
    </li>
    <li>
        {{ Form::submit('Buscar');}}
    </li>
    {{ Form::close() }}
</ul>

<ul>
    <?php foreach ($viewEventos as $viewEvento) { ?>
        <li>
        <group>
            <h2><a href="evento/ver/{{ $viewEvento->i_evento_id }}">{{ $viewEvento->v_evento_titulo }}</a></h2>
            <h3>{{ $viewEvento->v_categoria_descripcion }}</h3>
            <p>{{ $viewEvento->v_evento_descripcion }}</p>
            <span>Inicio: </span><date>{{ $viewEvento->d_evento_inicio }}</date>
            <span>Fin: </span><date>{{ $viewEvento->d_evento_fin }}</date>
            <span>Autor: </span><a href="#{{ $viewEvento->i_usuario_id }}">{{ $viewEvento->v_usuario_nombre }} {{ $viewEvento->v_usuario_apellidos }}</a>
        </group>
    </li>
<?php } ?>

{{ $mensaje }}
</ul>
Página actual : <?php echo $viewEventos->getCurrentPage(); ?>
<?php echo $viewEventos->links(); ?>
