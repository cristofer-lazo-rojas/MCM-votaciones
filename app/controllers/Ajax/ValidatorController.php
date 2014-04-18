<?php

class Ajax_ValidatorController extends BaseController {

    public function get_prueba() {
        return View::make('usuario.formRegistro');
    }

    public function post_datos() {
        print_r(Input::all());
    }

    public function get_usuarioexistemail() {
        echo "get_usuarioExistEmail";
    }

    public function post_usuarioexistemail() {
        if (Request::ajax()) {
            $rules = array(
                'email' => 'required|email|unique:credenciales,v_credenciales_email'
            );
            $messages = array(
                'required' => '',
                'email' => '',
                'unique' => 'El :attribute ingresado no existe.'
            );
            $validation = Validator::make(Input::all(), $rules, $messages);
            if ($validation->fails()) {
                return Response::json(array(
                            'success' => false,
                            'errors' => $validation->getMessageBag()->toArray()
                ));
            } else {
                return Response::json(array(
                            'success' => true,
                            'message' => "E-mail válido"
                ));
            }
        }
    }

}
