<?php

class Categoria extends Eloquent {

    protected $table = 'categoria';
    protected $primaryKey = "i_categoria_id";
    public $timestamps = false;

    /* Campos de la tabla 'candidato'
     * 
     * i_candidato_id
     * i_evento_id
     * v_candidato_nombre
     * v_candidato_ruta_imagen
     * i_candidato_estado
     */

    public function evento() {
        return $this->hasMany('Evento', 'i_evento_id', 'i_evento_id');
    }

}