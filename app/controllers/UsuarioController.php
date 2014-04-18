<?php

class UsuarioController extends BaseController {

    protected $layout = 'layouts.master';

    function loginUsuario() {
        return View::make("usuario.loginView");
    }

    function registrarUsuario() {

        $usuario = new Usuario();
        $credenciales = new Credenciales();

        $nombres = mb_strtolower(trim(Input::get('nombres')));
        $apellidos = mb_strtolower(trim(Input::get('apellidos')));
        $email = mb_strtolower(trim(Input::get('email')));
        // Obtenemos la contraseña enviada 
        $confirmPassword = Input::get('password_confirmation');
        $password = Input::get('password');
        //$data=Input::all();exit();
        //
        //realizamos la validación de los datos recibidos
        if ($usuario->isValid($nombres, $apellidos, $email, $confirmPassword, $password)) {
            $msg = "";
            if (!$credenciales->existEmail($email)) {
                echo "registrado"; exit();
                $usuario->v_usuario_nombre = $nombres;
                $usuario->v_usuario_apellidos = $apellidos;
                $usuario->i_usuario_estado = 1;
                $usuario->d_usuario_creacion = date("Y-m-d H:i:s");
                $usuario->i_usuario_admin = 0;
                //$usuario->save();
                // Guardamos sus credenciales
                $credenciales->i_usuario_id = $usuario->i_usuario_id;
                $credenciales->v_credenciales_email = $email;
                $credenciales->v_credenciales_password = Hash::make($password);
                $credenciales->i_credenciales_estado = 1;
                $credenciales->d_credenciales_creacion = date("Y-m-d H:i:s");
                //$credenciales->save();
                
                echo "registrado"; exit();
                return Redirect::route('/');
            } else {
                $msg = "$email ya existe";
                $email = null;
            }

            return Redirect::back()->with('msg', $msg)->with('email', $email);
        }
        //la validación de datos ha fallado -> re-direccionamos 
        //a la págna anterior con todos los mensages de error de entrada de datos
        return Redirect::back()->withInput()->withErrors($usuario->getErrors());
    }

}
