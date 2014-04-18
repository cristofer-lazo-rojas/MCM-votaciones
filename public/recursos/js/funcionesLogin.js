$(document).ready(function(){

	$("#input_login_submit").click(function(){
		var email = $("#input_login_email").val();
		var password = $("#input_login_password").val();
		if(email=="" && password==""){
			alert("Llene ambos campos");
			return false;
		}else{$("#form_login").submit();}
	});
	$("input[name='imagenPerfil']").change(function(){
		var archivo = $(this).val();
		aux = archivo.split(".");
		l = aux.length;
		extension = aux[l-1];
		if(extension!="jpeg" && extension != 'png' && extension !='jpg' ){
			$(this).val("");
			alert("formato incorrecto");
		}
	});

});

