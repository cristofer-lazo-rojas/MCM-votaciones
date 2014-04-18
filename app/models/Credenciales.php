<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Credenciales extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'credenciales';
    
    protected $primaryKey = "i_credenciales_id";
    public $timestamps = false;
    protected $fillable = array('v_credenciales_email', 'v_credenciales_password');
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('v_credenciales_password');
    

    public function usuario() {
        return $this->belongsTo('Usuario','i_usuario_id');
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier() {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->v_credenciales_password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getErrorsCredencial(){
        return $this->errors;
    }
    
    public function getReminderEmail() {
        return $this->v_credenciales_email;
    }
    
    public function isValid($email, $password) {
        $data = array('E-mail' => $email, 'Password' => $password);
        $rules = array(
            'E-mail' => 'required|email|min:1',
            'Password' => 'required|min:6'
        );

        $validator = Validator::make($data, $rules);

        if ($validator->passes()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }
    
    public function existEmail($email){
        $count=Credenciales::where('v_credenciales_email','=',$email)->count();
        if($count==0)
            return false;
        return true;
    }
}