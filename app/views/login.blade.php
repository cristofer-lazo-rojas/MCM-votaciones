{{HTML::style("recursos/ajax/css/ajax-validator.css")}}
{{HTML::script("recursos/ajax/ajax-validator.js")}}
<!-- Atributos del Formulario de login --> 
<?php
$attrib = array(
    'form' => array(
        'url' => 'login', 
        'method' => 'POST', 
        'id' => 'form-login'
    ),
    'email' => array(
        'placeholder' => 'E-mail',
        'id' => 'email',
        'class' => 'form-control',
        'data-validation' => 'email'
    ),
    'password'=>array(
        'placeholder' => 'Password', 
        'id' => 'password', 
        'class' => 'form-control', 
        'data-validation' => 'length', 
        'data-validation-length' => 'min4'
    ),
    'submit'=>array(
        'class'=>'btm'
    )
);
?>
<!-- Formulario de login --> 
{{ Form::open($attrib['form']) }}
<div class="form-group">
    {{ Form::email('email', $value = null, $attrib['email']) }}
    <small id="email-error" ></small>
</div>
<div class="form-group">
    {{ Form::password('password', $attrib['password']) }}
    <small id="password-error" ></small>
</div>
{{ Form::submit('Login', $attrib['submit']) }}
{{ Form::close() }}

<!--en este div mostramos el preloader-->
<div style="margin: 10px 0px 0px 48%" class="before"></div>     

<div class="errors_form"></div>
<?php
if (Session::get('msg'))
    $msg = Session::get('msg');
else
    $msg = null;

echo $msg;
?>

<script>    
     jQuery(document).ready(function($) {
     //petición al enviar el formulario de registro
     var validatorAjaxFormLogin = new ValidatorAjaxForm($('#form-login'));
     });     
</script>
