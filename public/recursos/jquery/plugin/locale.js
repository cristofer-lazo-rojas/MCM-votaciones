
function localeFormValidator(locale) {
    var LANG;
    switch (locale) {
        case 'es':
            LANG = {
                errorTitle: 'El envío de formularios falló!',
                requiredfields: 'No ha respondido a todos los campos requeridos',
                badtime: 'No ha dado una hora correcta',
                badEmail: 'Formato de E-mail incorrecto',
                badTelephone: 'Número de teléfono incorrecto',
                badSecurityAnswer: 'Respuesta incorrecta a la pregunta de seguridad',
                badDate: 'Fecha incorrecta',
                lengthBadStart: 'El valor debe estar entre ',
                lengthBadEnd: ' caracteres',
                lengthTooLongStart: 'El valor más largo es de ',
                lengthTooShortStart: 'El valor más corto es de ',
                notConfirmed: 'Los valores no se pudieron confirmar',
                badDomain: 'Valor de dominio incorrecto',
                badUrl: 'URL incorrecta',
                badCustomVal: 'Respuesta incorrecta',
                badInt: 'Valor no es numérico',
                badSecurityNumber: 'Número de seguro social incorrecto',
                badUKVatAnswer: 'Número UK VAT incorrecto',
                badStrength: 'La contraseña no es lo suficientemente fuerte ',
                badNumberOfSelectedOptionsStart: 'Elegir al menos ',
                badNumberOfSelectedOptionsEnd: " respuestas",
                badAlphaNumeric: 'La respuesta que diste debe contener sólo caracteres alfanuméricos ',
                badAlphaNumericExtra: ' y',
                wrongFileSize: 'El archivo demasiado grande ',
                wrongFileType: 'El archivo es de tipo incorrecto ',
                groupCheckedRangeStart: 'Por favor, elija entre ',
                groupCheckedTooFewStart: 'Por favor, elija al menos ',
                groupCheckedTooManyStart: 'Por favor, elija un máximo de ',
                groupCheckedEnd: ' item(s)'
            };
            break;
        case 'en':
        default:
            LANG = {
                errorTitle: 'Form submission failed!',
                requiredFields: 'You have not answered all required fields',
                badTime: 'You have not given a correct time',
                badEmail: 'You have not given a correct e-mail address',
                badTelephone: 'You have not given a correct phone number',
                badSecurityAnswer: 'You have not given a correct answer to the security question',
                badDate: 'You have not given a correct date',
                lengthBadStart: 'You must give an answer between ',
                lengthBadEnd: ' characters',
                lengthTooLongStart: 'You have given an answer longer than ',
                lengthTooShortStart: 'You have given an answer shorter than ',
                notConfirmed: 'Values could not be confirmed',
                badDomain: 'Incorrect domain value',
                badUrl: 'The answer you gave was not a correct URL',
                badCustomVal: 'You gave an incorrect answer',
                badInt: 'The answer you gave was not a correct number',
                badSecurityNumber: 'Your social security number was incorrect',
                badUKVatAnswer: 'Incorrect UK VAT Number',
                badStrength: 'The password isn\'t strong enough',
                badNumberOfSelectedOptionsStart: 'You have to choose at least ',
                badNumberOfSelectedOptionsEnd: ' answers',
                badAlphaNumeric: 'The answer you gave must contain only alphanumeric characters ',
                badAlphaNumericExtra: ' and ',
                wrongFileSize: 'The file you are trying to upload is too large',
                wrongFileType: 'The file you are trying to upload is of wrong type',
                groupCheckedRangeStart: 'Please choose between ',
                groupCheckedTooFewStart: 'Please choose at least ',
                groupCheckedTooManyStart: 'Please choose a maximum of ',
                groupCheckedEnd: ' item(s)'
            };
            break;
    }
    return LANG;
}