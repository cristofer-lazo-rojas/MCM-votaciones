<?php

class Voto extends Eloquent {

    protected $table = 'voto';
    protected $primaryKey = "i_voto_id";
    public $timestamps = false;
    public $errors;

    //public $incrementing = false;

    /* Campos de tabla 'voto'
     * 
     * i_voto_id
     * i_usuairo_id
     * i_candidato_id
     * d_voto_creacion
     * 
     */


    public function usuario() {
        return $this->belongsTo('Usuario');
    }

    public function candidato() {
        return $this->belongsTo('Candidato');
    }

    public function votoRealizado($i_usuario_id, $i_candidato_id) {
        $numRow = Voto::where('i_usuario_id', '=', $i_usuario_id)->where('i_candidato_id', '=', $i_candidato_id)->count();
        if ($numRow == 0)
            return false;
        return true;
    }
    /* Solo inserta voto valido:
     * - Existe candidato en evento
     * - Usuario esta invitado en el evento */
    public function insertVoto($i_usuario_id, $i_candidato_id, $i_evento_id) {
        $evento = new Evento();

        if ($evento->usuarioInvitado($i_evento_id, $i_usuario_id) &&
                $evento->exixteCandidato($i_candidato_id, $i_evento_id) &&
                !$this->votoRealizado($i_usuario_id, $i_candidato_id)) {

            $voto = new Voto();
            $voto->i_usuario_id = $i_usuario_id;
            $voto->i_candidato_id = $i_candidato_id;
            $voto->d_voto_creacion = date("Y-m-d H:i:s");
            $voto->save();
        }
    }

}