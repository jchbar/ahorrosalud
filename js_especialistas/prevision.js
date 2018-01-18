$(document).ready(function() {
    $('#guardarDatos').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: 
        {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            contacto: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
             },
            contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
             },
            alias: {
                validators: {
                    notEmpty: {
                        message: 'El alias es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Debe tener menos de 30 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            direccion1: {
                validators: {
                    notEmpty: {
                        message: 'La direccion es necesaria y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 60,
                        message: 'Debe tener menos de 60 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            direccion2: {
                validators: {
                    notEmpty: {
                        message: 'La direccion es necesaria y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 60,
                        message: 'Debe tener menos de 60 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            email_contacto:  {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            email_contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            rif: {
                validators: {
                    notEmpty: {
                        message: 'El numero de la cuenta no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[JGCVE0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min:10,
                        max:10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            cuenta: {
                validators: {
                    notEmpty: {
                        message: 'El numero de la cuenta no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 20,
                        max: 20,
                        message: 'No debe ser mayor a 20 digitos'
                    }
                }
            },
            cedula: {
                validators: {
                    notEmpty: {
                        message: 'La cedula no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            celular1: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            celular2: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono_contacto: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono_contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            montodecimal: {
                validators: {
                   numeric: {
                            message: 'El valor no es numerico',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        },   
                    notEmpty: {
                        message: 'el monto no puede estar vacia'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required and cannot be empty'
                    },
                    stringLength: {
                        max: 100,
                        message: 'The title must be less than 100 characters long'
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: 'The content is required and cannot be empty'
                    },
                    stringLength: {
                        max: 500,
                        message: 'The content must be less than 500 characters long'
                    }
                }
            }
        } // fields
    }); // formulario 

    $('#actualizarDatos').bootstrapValidator({
        container: '#messagesm',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: 
        {
            nombre: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            contacto: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
             },
            contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'El nombre es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 50,
                        message: 'Debe tener menos de 50 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
             },
            alias: {
                validators: {
                    notEmpty: {
                        message: 'El alias es necesario y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'Debe tener menos de 30 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            direccion1: {
                validators: {
                    notEmpty: {
                        message: 'La direccion es necesaria y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 60,
                        message: 'Debe tener menos de 60 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            direccion2: {
                validators: {
                    notEmpty: {
                        message: 'La direccion es necesaria y no puede estar vacio',
                    },
                    stringLength: {
                        min: 3,
                        max: 60,
                        message: 'Debe tener menos de 60 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras mayusculas',
                        'case': 'upper'
                    }
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            email_contacto:  {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            email_contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'El email no puede estar vacio'
                    },
                    emailAddress: {
                        message: 'El email puede ser invalido'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'Debe tener menos de 100 caracteres'
                    },
                    stringCase: {
                        message: 'Debe colocar solo letras minyusculas',
                        'case': 'lower'
                    }
                },
            },
            rif: {
                validators: {
                    notEmpty: {
                        message: 'El numero de la cuenta no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[JGCVE0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min:10,
                        max:10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            cuenta: {
                validators: {
                    notEmpty: {
                        message: 'El numero de la cuenta no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 20,
                        max: 20,
                        message: 'No debe ser mayor a 20 digitos'
                    }
                }
            },
            cedula: {
                validators: {
                    notEmpty: {
                        message: 'La cedula no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            celular1: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            celular2: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono_contacto: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            telefono_contacto_adm: {
                validators: {
                    notEmpty: {
                        message: 'La telefono no puede estar vacia'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Puede contener solo numeros'
                    },
                    stringLength: {
                        min: 0,
                        max: 11,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            montodecimal: {
                validators: {
                   numeric: {
                            message: 'El valor no es numerico',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        },   
                    notEmpty: {
                        message: 'el monto no puede estar vacia'
                    },
                    stringLength: {
                        min: 5,
                        max: 10,
                        message: 'No debe ser mayor a 10 digitos'
                    }
                }
            },
            title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required and cannot be empty'
                    },
                    stringLength: {
                        max: 100,
                        message: 'The title must be less than 100 characters long'
                    }
                }
            },
            content: {
                validators: {
                    notEmpty: {
                        message: 'The content is required and cannot be empty'
                    },
                    stringLength: {
                        max: 500,
                        message: 'The content must be less than 500 characters long'
                    }
                }
            }
        } // fields
    });
});

