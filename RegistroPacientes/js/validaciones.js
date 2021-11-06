var formulario = document.getElementById('formulario'),
    cui = formulario.cui,
    nombres = formulario.nombres,
    apellidos = formulario.apellidos,
    dateH = formulario.dateH,
    direccion = formulario.direccion,
    nombresP = formulario.nombresP,
    nombresM = formulario.nombresM,
    correo = formulario.correo,
    error = document.getElementById('error');

/*      validar el código único de identificación debe de ser igual a 13 dígitos y solo dígitos. 
        Validar todos los inputs que no debe de estar vacíos.
         Validar fecha nacimiento mayor a fecha actual. 
         Validar correo electrónico si este está mal escrito.

*/


function vCUI(e) {

    var cui = document.querySelector('#cui').value.length

    if (cui < 13 || cui > 13) {
        error.style.display = 'block';
        error.innerHTML += '<li>Por favor ingresa un CUI valido. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }

}

function validar_email(email) {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email) ? true : false;
}

function validarEmail(valor, e) {

    if (validar_email(valor)) {

        alert("La dirección de email " + valor + " es correcta.");
        error.style.display = 'none';
    } else {
        alert("La dirección de email es incorrecta.");
        error.style.display = 'block';
        error.innerHTML += '<li>La dirección de email es incorrecta.</li>';
        e.preventDefault();
    }
}


function vFechaN(e) {
    var hoy = new Date();
    var fechaFormulario = new Date(dateH.value);
    // Comparamos solo las fechas => no las horas!!
    hoy.setHours(0, 0, 0, 0); // Lo iniciamos a 00:00 horas

    if (hoy <= fechaFormulario) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor ingresa una fecha valida. </li>';
        e.preventDefault();
    } else {
        error.style.display = 'none';
    }
}

function vCcui(e) {
    if (cui.value == '' || cui.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena el campo de CUI. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}

function vCnombre(e) {
    if (nombres.value == '' || nombres.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena el campo de Nombres. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}

function vCapellido(e) {
    if (apellidos.value == '' || apellidos.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena  el campo de Apellidos. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}

function vCdireccion(e) {
    if (direccion.value == '' || direccion.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena  el campo de dirección. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}


function vCnombreP(e) {
    if (nombresP.value == '' || nombresP.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena el campo de Nombre de Padre.</li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}

function vCnombreM(e) {
    if (nombresM.value == '' || nombresM.value == null) {
        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena el campo de Nombre de la Mamá.</li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}

function vCcorreo(e) {
    if (correo.value == '' || correo.value == null) {

        error.style.display = 'block';
        error.innerHTML += '<li>Por favor rellena el campo de Correo. </li>';
        e.preventDefault();

    } else {
        error.style.display = 'none';
    }
}



function validaciones(e) {
    error.innerHTML = '';

    vCcui(e);

    vCnombre(e);

    vCapellido(e);

    vCdireccion(e);

    vCnombreP(e);

    vCnombreM(e);

    vCcorreo(e);
    vFechaN(e)
    vCUI(e);

    validarEmail(email, e)
    alert('aca');

}
formulario.addEventListener('submit', validaciones);