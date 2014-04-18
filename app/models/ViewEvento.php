<?php
/*
create view view_evento as
select ev.i_evento_id, ev.v_evento_titulo, ev.v_evento_descripcion,
ev.d_evento_inicio, ev.d_evento_fin, ev.i_evento_privacidad,
ev.v_evento_identificador, cat.i_categoria_id, cat.v_categoria_descripcion,
usu.i_usuario_id, usu.v_usuario_nombre, usu.v_usuario_apellidos 
from evento ev, categoria cat, usuario usu
where ev.i_categoria_id = cat.i_categoria_id
and ev.i_usuario_id = usu.i_usuario_id
and i_evento_estado='1';
 * 
 */
class ViewEvento extends Eloquent {
    
    protected $table = 'view_evento';
    public $timestamps = false;   

}
