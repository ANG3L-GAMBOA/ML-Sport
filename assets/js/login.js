const frm = document.querySelector('#frmLogin');
const email = document.querySelector('#email');
const password = document.querySelector('#password');

document.addEventListener('DOMContentLoaded', function () {
    var working = false;
    frm.onsubmit = function (e) {
        e.preventDefault();
        if (email.value == '' || password.value == '') {
            message('error', 'TODO LOS CAMPOS CON * SON REQUERIDOS');
        } else {
            if (working) return;
            working = true;
            var $this = $(this),
                $state = $this.find('button > .state');
            $this.addClass('loading');
            $state.html('Authenticating');

            axios.post(ruta + 'controllers/usuariosController.php?option=acceso', {
                email: email.value,
                password: password.value
            })
                .then(function (response) {
                    const info = response.data;
                    if (info.tipo == 'success') {
                        setTimeout(() => {
                            $this.addClass('ok');
                            $state.html('Welcome back!'); $this.addClass('ok');
                            $state.html('Welcome back!');
                            setTimeout(() => {
                                window.location = ruta + 'plantilla.php';
                            }, 2000);

                        }, 3000);

                    } else {
                        setTimeout(function () {
                            $state.html('Login');
                            $this.removeClass('ok loading');
                            working = false;
                            message(info.tipo, info.mensaje);
                        }, 2000);
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }

})

function message(tipo, mensaje) {
    Snackbar.show({
        text: mensaje,
        pos: 'top-right',
        backgroundColor: tipo == 'success' ? '#079F00' : '#FF0303',
        actionText: 'Cerrar'
    });
}