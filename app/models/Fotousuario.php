<?php

class Fotousuario extends Eloquent {

    protected $table = 'fotousuario';
    protected $primaryKey = "i_fotousuario_id";
    public $timestamps = false;
    public $errors;
    //public $incrementing = false;
   
   
    public function Usuario() {
        return $this->belongsTo('Usuario');
    }

}
