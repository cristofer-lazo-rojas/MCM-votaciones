<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| such as the size rules. Feel free to tweak each of these messages.
	|
	*/

	"accepted"         => "El :attribute debe ser aceptado. ",
	"active_url"       => "El :attribute no es una URL válida. ",
	"after"            => "El :attribute debe ser una fecha posterior a :date ",
	"alpha"            => "El :attribute sólo puede contener letras. ",
	"alpha_dash"       => "El :attribute sólo puede contener letras , números y guiones ",
	"alpha_num"        => "El :attribute sólo puede contener letras y números. ",
	"array"            => "El :attribute debe ser una matriz. ",
	"before"           => "El :attribute debe ser una fecha anterior a :date ",
	"between"          => array(
		"numeric" => "El :attribute debe estar comprendido entre :mín y :max. ",
		"file"    => "El :attribute debe estar comprendido entre :mín y :max kilobytes. ",
		"string"  => "El :attribute debe estar entre :min y :max caracteres. ",
		"array"   => "El :attribute debe estar comprendido entre :min y :max items.",
	),
	"confirmed"        => "El :attribute confirmado no coincide ",
	"date"             => "El :attribute no es una fecha válida.",
	"date_format"      => "El :attribute no coincide con el formato :format.",
	"different"        => "El :attribute y :other deben ser diferentes.",
	"digits"           => "El :attribute debe ser de :digits dígitos.",
	"digits_between"   => "El :attribute debe estar entre :min y :max dígitos.",
	"email"            => "El formato de :attribute no es válido.",
	"exists"           => "El campo :attribute no existe.",
	"image"            => "El :attribute debe ser una imagen.",
	"in"               => "El :attribute seleccionado no es válido.",
	"integer"          => "El :attribute debe ser un entero.",
	"ip"               => "El :attribute debe ser una dirección IP válida.",
	"max"              => array(
		"numeric" => "El :attribute no puede ser superior :max dígitos.",
		"file"    => "El :attribute no puede ser superior :max kilobytes.",
		"string"  => "El :attribute no puede ser superior :max caracteres.",
		"array"   => "El :attribute no puede ser superior :max items.",
	),
	"mimes"            => "The :attribute must be a file of type: :values.",
	"min"              => array(
		"numeric" => "El :attribute debe tener al menos :min dígitos.",
		"file"    => "El :attribute debe tener al menos :min kilobytes.",
		"string"  => "El :attribute debe tener al menos :min caracteres.",
		"array"   => "El :attribute debe tener al menos :min items.",
	),
	"not_in"           => "El :attribute seleccionado no es válido.",
	"numeric"          => "El :attribute debe ser un número.",
	"regex"            => "El formato de :attribute no es válido.",
	"required"         => "El campo :attribute es requerido.",
	"required_if"      => "El campo :attribute es requerido cuando :other es :value.",
	"required_with"    => "El campo :attribute es requerido cuando :values es present.",
	"required_without" => "El campo :attribute es requerido cuando :values no esta presente.",
	"same"             => "El :attribute y :other deben coincidir.",
	"size"             => array(
		"numeric" => "El :attribute debe ser :size.",
		"file"    => "El :attribute debe ser :size kilobytes.",
		"string"  => "El :attribute debe ser :size caracteres.",
		"array"   => "El :attribute debe contener :size items.",
	),
	"unique"           => "El :attribute ya ha sido tomado.",
	"url"              => "El formato de :attribute no es válido.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
