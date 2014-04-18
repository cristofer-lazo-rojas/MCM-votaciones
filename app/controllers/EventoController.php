<?php

use ElephantIO\Client as ElephantIO;

class EventoController extends BaseController {

    protected $layout = 'layouts.master';

    public function showEventos() {

        $page = isset($_POST['page']) ? $_POST['page'] : 1;

        $is_idCategoria = !empty($_POST['idCategoria']) ? '=' : '!=';
        $idCategoria = !empty($_POST['idCategoria']) ? $_POST['idCategoria'] : 999999999;

        $dateIniEvento = !empty($_POST['dateIniEvento']) ? $_POST['dateIniEvento'] . ' 00:00:00' : "2014-02-01 00:00:00";

        $is_privacidadEvento = !empty($_POST['privacidadEvento']) ? '=' : '!=';
        $op_privacidadEvento = !empty($_POST['privacidadEvento']) ? $_POST['privacidadEvento'] : '';

        switch ($op_privacidadEvento) {
            case '1': $privacidadEvento = 0;
                break;
            case '2': $privacidadEvento = 1;
                break;
            default: $privacidadEvento = 2;
                break;
        }

        $tituloEvento = isset($_POST['tituloEvento']) ? $_POST['tituloEvento'] : '';

        $mensaje = "";


        $viewEventos = viewEvento::where('i_categoria_id', $is_idCategoria, $idCategoria)
                ->where('i_evento_privacidad', $is_privacidadEvento, $privacidadEvento)
                ->where('d_evento_inicio', '>=', $dateIniEvento)
                ->where('v_evento_titulo', 'like', "%$tituloEvento%")
                ->orderBy('d_evento_inicio', 'desc')
                ->paginate(10);


        /*
          $eventos = Evento::with('categoria', 'usuario')
          ->where('i_categoria_id', $is_idCategoria, $idCategoria)
          ->where('i_evento_privacidad', $is_privacidadEvento, $privacidadEvento)
          ->where('d_evento_inicio', '>=', $dateIniEvento)
          ->where('v_evento_titulo', 'like', "%$tituloEvento%")
          ->orderBy('d_evento_inicio','desc')
          ->paginate(10);

          foreach ($eventos as $value) {
          print_r($value); echo"<br/><br/>";
          }
          exit();
         * 
         */

        $categorias = Categoria::all();

        $filter = array(
            "page" => isset($_POST['page']) ? $_POST['page'] : '',
            "idCategoria" => isset($_POST['idCategoria']) ? $_POST['idCategoria'] : '',
            "dateIniEvento" => isset($_POST['dateIniEvento']) ? ($_POST['dateIniEvento']) : '',
            "privacidadEvento" => isset($_POST['privacidadEvento']) ? $_POST['privacidadEvento'] : '',
            "tituloEvento" => isset($_POST['tituloEvento']) ? $_POST['tituloEvento'] : ''
        );

        //print_r($filter);

        if (!$viewEventos)
            $mensaje = "No existe eventos";

        $nav = View::make('layouts.nav', compact("viewEventos", "mensaje"));
        $content = View::make('evento.eventos', compact("viewEventos", "categorias", "filter", "mensaje"));
        $this->layout->contenido = View::make('main', compact("content"));
    }

    public function nuevoEvento() {
        
    }

    public function verEvento($id_evento) {

        $eventoValidate = new Evento();

        $viewEvento = ViewEvento::where('i_evento_id', '=', $id_evento)->first();
        //print_r($viewEvento);exit();
        $candidatos = Candidato::where('i_evento_id', '=', $viewEvento->i_evento_id)->get();

        //return print_r($candidatos);
        $fotocreador = Fotousuario::where($viewEvento->i_usuario_id);

        $usuarioSessionId = Session::get('usuario.id');

        $votoClausurado = true;

        $usuarioInvitado = $eventoValidate->usuarioInvitado($id_evento, $usuarioSessionId);

        if ($usuarioInvitado)
            $votoClausurado = $eventoValidate->existeVotoUsuario($usuarioSessionId, $candidatos);

        $mensaje = $this->mensajeVerEvento($votoClausurado, $usuarioInvitado);

        
        $elephant = new ElephantIO('http://localhost:3000', 'socket.io', 1, false, true, true);
        $elephant->init();
        $elephant->send(
                ElephantIO::TYPE_EVENT, null, null, json_encode(array('name' => 'newUser', 'args' => array('_tocken' => '09200094', 'room' => $viewEvento->i_evento_id, 'userId' => $usuarioSessionId, 'MAC' => $_SERVER['REMOTE_ADDR'])))
        );
        $elephant->close();
        

        $nav = View::make("layouts.nav");
        $content = View::make('evento.verEvento', compact("nav", "viewEvento", "candidatos", "fotocreador", "votoClausurado", "mensaje"));
        $this->layout->content = View::make('main', compact("content"));
    }

    /* Metodo para realizar votacion de un evento
     */

    public function votarEvento() {

        $usuarioSessionId = Session::get('usuario.id');

        $data = Input::all(); //echo print_r($data);    exit();
        $i_candidato_id = $data['id_candidato'];
        $id_evento = $data['id_evento'];

        $voto = new Voto();
        $voto->insertVoto($usuarioSessionId, $i_candidato_id, $id_evento);

        return Redirect::route('verEvento', compact('id_evento'));
    }

    /* Mensaje que se mostrara en un evento */

    public function mensajeVerEvento($votoClausurado, $usuarioInvitado) {
        $mensaje = "";
        if ($votoClausurado && $usuarioInvitado) {
            $mensaje = "Ya realizaste votacion";
        }
        if ($votoClausurado && !$usuarioInvitado) {
            $mensaje = "Lo sentimos para poder votar debes de estar invitado el evento";
        }
        return $mensaje;
    }

}
