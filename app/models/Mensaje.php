<?php

class Mensaje extends Eloquent {

    protected $table = 'mensaje';
    protected $primaryKey = "i_mensaje_id";
    public $timestamps = false;
    public $errors;
    //public $incrementing = false;
    
    /* Campos de tabla 'mensaje'
     * 
     * i_mensaje_id
     * i_evento_id
     * i_usuario_id
     * t_mensaje_texto
     * d_mensaje_creacion
     * i_mensaje_estado
     * 
     */

    public function evento() {
        return $this->belongsTo('Evento');
    }

    public function usuario() {
        return $this->belongsTo('Usuario');
    }

}