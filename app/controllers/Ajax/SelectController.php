<?php

class Ajax_SelectController extends BaseController {
    public function post_mensajes() {
        if (Request::ajax()) {
            $data=array(
                'eventId' => (int)Input::get('eventId'),
                'userId' => (int)Input::get('userId')
            );
            $rules = array(
                'eventId' => 'required|integer|exists:evento,i_evento_id',
                'userId' => 'required|integer|exists:usuario,i_usuario_id'
            );
            $messages = array(
                'required' => ':attribute es requerido.',
                "integer" => ":attribute debe ser un entero.",
                "exists" => ":attribute no existe."
            );
            
            $validation = Validator::make(Input::all(), $rules, $messages);
            
            
            if ($validation->fails()) {
                return Response::json(array(
                            'success' => false,
                            'errors' => $validation->getMessageBag()->toArray()
                ));
            } else {
                $viewMensajes =  ViewMensajes::where('eventId','=',Input::get('eventId'))->take(10)->skip(0)->get();
                $mensajes=array();
                foreach ($viewMensajes as $value) {
                    $mensajes[]=array(
                        'msgId'=>$value->editor,
                        'eventId'=>$value->eventId,
                        'userId'=>$value->userId,
                        'avatar'=>$value->avatar,
                        'editor'=>$value->editor,
                        'msg'=>$value->msg,
                        'fecha'=>$value->fecha,
                    );                
                }
                return Response::json(array(
                            'success' => true,
                            'mensaje' => $mensajes
                ));
            }
        }
    }
}