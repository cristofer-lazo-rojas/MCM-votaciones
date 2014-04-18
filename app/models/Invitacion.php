<?php

class Invitacion extends Eloquent {

    protected $table = 'invitacion';
    protected $primaryKey = "i_invitacion_id";
    public $timestamps = false;
    public $errors;
    //public $incrementing = false;
   
    /* Campos de tabla 'invitacion'
     * 
     * i_invitacion_id
     * i_evento_id
     * v_invitacion_email
     * d_invitacion_creacion
     * 
     */
    public function evento() {
        return $this->belongsTo('Evento');
    }

}