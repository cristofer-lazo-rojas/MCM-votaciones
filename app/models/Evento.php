<?php

class Evento extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'evento';
    protected $primaryKey = "i_evento_id";
    public $timestamps = false;
    public $errors;

    /* Campos de tabla 'evento'
     * 
     * i_usuario_id, 
     * i_categoria_id, 
     * v_evento_titulo, 
     * v_evento_descripcion, 
     * d_evento_inicio, 
     * d_evento_fin, 
     * d_evento_creacion, 
     * i_evento_estado, 
     * i_evento_privacidad, 
     * v_evento_identificador, 
     * i_evento_check         
     */

    //public $incrementing = false;
    //protected $fillable = array('v_usuario_nombre', 'v_usuario_apellidos');

    public function categoria() {
        return $this->belongsTo('Categoria','i_categoria_id');
    }

    public function usuario() {
        return $this->belongsTo('Usuario','i_usuario_id');
    }
    
    public function candidato() {
        return $this->hasMany('Candidato','i_evento_id', 'i_evento_id');
    }
    
    public function invitacion() {
        return $this->hasMany('Invitacion', 'i_evento_id', 'i_evento_id');
    }

    public function mensaje() {
        return $this->hasMany('Mensaje', 'i_evento_id', 'i_evento_id');
    }


    public function eventoPrivado($i_evento_id) {
        $evento = Evento::where('i_evento_id', '=', $i_evento_id)->first();
        if ($evento->i_evento_privacidad == 1) {
            return true;
        }
        return false;
    }

    public function usuarioInvitado($i_evento_id, $i_usuario_id) {
        $eventoPrivado = $this->eventoPrivado($i_evento_id);
        if ($eventoPrivado) {
            $credenciales = Credenciales::where('i_usuario_id', '=', $i_usuario_id)->where('i_credenciales_estado', '=', 1)->first();
            $numRow = Invitacion::where('i_evento_id', '=', $i_evento_id)->where('v_invitacion_email', '=', $credenciales->v_credenciales_email)->count();
            if ($numRow == 0)
                return false;
        }
        return true;
    }

    public function existeVotoUsuario($i_usuario_id, $candidatos) {
        foreach ($candidatos as $candidato) {
            $numRow = Voto::where('i_usuario_id', '=', $i_usuario_id)->where('i_candidato_id', '=', $candidato->i_candidato_id)->count();
            if ($numRow > 0)
                return true;
        }
        return false;
    }

    public function exixteCandidato($i_candidato_id, $i_evento_id) {
        $numRow = Candidato::where('i_candidato_id', '=', $i_candidato_id)->where('i_evento_id', '=', $i_evento_id)->count();
        if ($numRow == 0)
            return false;
        return true;
    }

}
