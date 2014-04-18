<?php

class AuthController extends BaseController {

    /**
     * Attempt user login
     */
    public function doLogin() {

        //comprobamos si es una petición ajax
        if (Request::ajax()) {
            //validamos el formulario
            $rules = array(
                'email' => 'required|email|min:6|max:100|exists:credenciales,v_credenciales_email',
                'password' => 'required|min:6|max:100'
            );

            $messages = array(
                'required' => 'El campo :attribute es obligatorio.',
                'min' => 'El campo :attribute no puede tener menos de :min carácteres.',
                'email' => 'El campo :attribute debe ser un email válido.',
                'max' => 'El campo :attribute no puede tener más de :min carácteres.',
                'exists' => 'El :attribute ingresado no existe.'
            );

            $validation = Validator::make(Input::all(), $rules, $messages);
            //si la validación falla redirigimos al formulario de registro con los errores
            if ($validation->fails()) {
                //como ha fallado el formulario, devolvemos los datos en formato json
                //esta es la forma de hacerlo en laravel, o una de ellas
                return Response::json(array(
                            'success' => false,
                            'errors' => $validation->getMessageBag()->toArray()
                ));
                //en otro caso ingresamos al usuario en la tabla usuarios
            } else {
                //creamos un nuevo usuario con los datos del formulario
                //si se realiza correctamente la inserción envíamos un mensaje
                //conforme se ha registrado correctamente
                return Response::json(array(
                            'success' => true,
                            'message' => "Datos de login correctos"
                ));
            }
        } else {
            $_token = Input::get('_token');
            $email = Input::get("email");
            $password = Input::get("password");

            $dataBack = array('v_credenciales_email' => $email, 'password' => $password);
            // Realizamos la autenticación
            if (Auth::attempt($dataBack)) {
                $usuario = Credenciales::with('usuario')->where('v_credenciales_email', '=', $email)->first()->usuario;
                Session::put('usuario.id', $usuario->i_usuario_id);
                Session::put('usuario.email', $email);
                Session::put('usuario.name', $usuario->v_usuario_nombre . ' ' . $usuario->v_usuario_apellidos);
                Session::put('usuario.admin', $usuario->i_usuario_admin);
                // devolver una vista (en este caso re-direccionamos a la página anterior)
            }

            return Redirect::back();
        }
    }

    /*
      public function doLogin() {
      // Obtenemos el email, borramos los espacios
      // y convertimos todo a minúscula
      $email = mb_strtolower(trim(Input::get('email')));
      // Obtenemos la contraseña enviada
      $password = Input::get('password');
      $credenciales = new Credenciales();
      //realizamos la validación de los datos recibidos
      if ($credenciales->isValid($email, $password)) {

      $dataBack = array('v_credenciales_email' => $email, 'password' => $password);
      // Realizamos la autenticación
      if (Auth::attempt($dataBack)) {
      $usuario = Credenciales::with('usuario')->where('v_credenciales_email', '=', $email)->first()->usuario;
      Session::put('usuario.id', $usuario->i_usuario_id);
      Session::put('usuario.email', $email);
      Session::put('usuario.name', $usuario->v_usuario_nombre . ' ' . $usuario->v_usuario_apellidos);
      Session::put('usuario.admin', $usuario->i_usuario_admin);
      // devolver una vista (en este caso re-direccionamos a la página anterior)
      return Redirect::back();
      }

      // Identificamos la falla de autenticación
      if ($credenciales->existEmail($email)) {
      $msg = "Password inválido";
      } else {
      $msg = "$email no está registrado";
      $email = null;
      }

      return Redirect::back()->with('err', 'errorLogin')->with('msg', $msg)->with('email', $email);
      }
      //la validación de datos ha fallado -> re-direccionamos
      //a la págna anterior con todos los mensages de error de entrada de datos
      return Redirect::back()->with('err', 'errorLogin')->withInput()->withErrors($credenciales->getErrorsCredencial());
      }
     */

    public function doLogout() {
        //Desconctamos al usuario
        Auth::logout();

        //Redireccionamos al inicio de la app con un mensaje
        return Redirect::to('/')->with('msg', 'Gracias por visitarnos!.');
    }

}
