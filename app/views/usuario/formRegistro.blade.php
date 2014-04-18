<?php
$attrib = array(
    'form' => array(
        'url' => 'registrarUsuario',
        'method' => 'POST',
        'id' => 'form-register'
    ),
    'nombres' => array(
        'placeholder' => 'Nombres',
        'id' => 'nombres',
        'class' => 'form-control',
        'data-validation' => 'length alpha',
        'data-validation-length'=>'3-12'
    ),
    'apellidos' => array(
        'placeholder' => 'Apellidos',
        'id' => 'apellidos',
        'class' => 'form-control',
        'data-validation' => 'length alpha',
        'data-validation-length'=>'3-12'
    ),
    'email' => array(
        'placeholder' => 'E-mail',
        'id' => 'email',
        'class' => 'form-control',
        'data-validation' => 'email'
    ),
    'password_confirmation' => array(
        'placeholder' => 'Password',
        'id' => 'password_confirmation',
        'class' => 'form-control',
        'data-validation' => 'strength',
        'data-validation-strength' => '1'
    ),
    'password' => array(
        'placeholder' => 'Password',
        'id' => 'password',
        'class' => 'form-control',
        'data-validation' => 'confirmation'
    ),
    'submit' => array(
        'class' => 'btm'
    )
);
?>

<div style="width: 400px; margin-top: 50px;padding: 10px; border: 1px solid;">
    <!-- Formulario de login --> 
    {{ Form::open($attrib['form']) }}
    <div class="form-group">
    {{ Form::label('nombres', 'Nombres: ') }}
    {{ Form::text('nombres', $value = null, $attrib['nombres']) }}
    </div>
    <div class="form-group">
    {{ Form::label('apellidos', 'Apellidos: ') }}
    {{ Form::text('apellidos', $value = null, $attrib['apellidos']) }}
    </div>
    <div class="form-group">
    {{ Form::label('email', 'E-mail: ') }}
    {{ Form::email('email', $value = null , $attrib['email']) }}
    <div id="email-error"></div>
    </div>
    <div class="form-group">
    {{ Form::label('password_confirmation', 'Password: ') }}
    {{ Form::password('password_confirmation', $attrib['password_confirmation']) }}
    </div>
    <div class="form-group">
    {{ Form::label('password', 'Repetir Password: ') }}
    {{ Form::password('password', $attrib['password']) }}
    </div>
    {{ Form::submit('Registrar') }}
    {{ Form::close() }}  
    <!--en este los errores del formulario--> 
    <div class="errors_form"></div>
    
     <?php       
       $url=  Request::url().'/ajaxValidator/usuarioexistemail';
     ?>
    <script>
        
        jQuery(document).ready(function($) {           
            var validatorAjaxEmail=new ValidatorAjaxInput($('#form-register #email'), '<?php echo $url?>', $('#form-register #email-error'));
        });
        
    </script>

</div>


