<?php

class Usuario extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuario';
    protected $primaryKey = "i_usuario_id";
    public $timestamps = false;
    public $errors;
    //public $incrementing = false;
    protected $fillable = array('v_usuario_nombre', 'v_usuario_apellidos');

    public function getErrors() {
        return $this->errors;
    }

    public function isValid($nombres, $apellidos, $email, $confirmPassword, $password) {
        $data = array('nombres' => $nombres, 'apellidos' => $apellidos, 'v_credenciales_email' => $email, 'confirmPassword' => $confirmPassword, 'password' => $password);
        $rules = array(
            'nombres' => 'required|min:2',
            'apellidos' => 'required|min:2',
            'v_credenciales_email' => 'required|email|min:1|unique:credenciales',
            'confirmPassword' => 'required|min:6',
            'password' => 'required|min:1|same:password'
        );
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function voto() {
        return $this->hasMany('Voto', 'i_voto_id', 'i_voto_id');
    }

    public function mensaje() {
        return $this->hasMany('Mensaje', 'i_mensaje_id', 'i_mensaje_id');
    }

    public function credenciales() {
        return $this->hasMany('Credenciales', 'i_credenciales_id', 'i_credenciales_id');
    }

    public function fotousuario() {
        return $this->hasMany('Fotousuario', 'i_fotousuario_id', 'i_fotousuario_id');
    }

}
