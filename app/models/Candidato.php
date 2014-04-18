<?php

class Candidato extends Eloquent {

    protected $table = 'candidato';
    protected $primaryKey = "i_candidato_id";
    public $timestamps = false;

    /* Campos de la tabla 'candidato'
     * 
     * i_candidato_id
     * i_evento_id, 
     * v_candidato_nombre, 
     * v_candidato_ruta_imagen, 
     * i_candidato_estado
     */

    public function evento() {
        return $this->belongsTo('Evento','i_evento_id');
    }
}
