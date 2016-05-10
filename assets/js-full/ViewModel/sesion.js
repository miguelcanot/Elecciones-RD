function Sesion() {
    var self = this;
    self.logV = ko.observable(true);
    self.passV = ko.observable(false);
    self.contrasenaCambiada = ko.observable(false);
 
    self.iniciarSesion = function () {
        if ($("#frm").valid()) {
            disableBottonForm();
            var url = pathApi + "usuario/apiiniciarsesion/"
            var usuario = $("#txtUsuario").val();
            var contrasena = $("#txtContrasena").val();
            $.post(url, {usuario:usuario, contrasena:contrasena}, function (data) {
                if (data["estatus"]) {
                    //mostrarMensajeS(data["mensaje"]);
                    redirect(pathWeb + "estadistica");
                } else {
                    enableBottonForm();
                    mostrarMensajeE(data["mensaje"], "", "M");
                }
            }, "json")
            .fail(function () {
                mostrarMensajeE(error00, "", "M");
                enableBottonForm();
            });
            return false;
        }
    }

    self.login = function () {
        var url = pathApi + "usuario/apiiniciarsesion/"
        $.post(url, { usuario: usuario }, function (data) {
            if (data["estatus"]) {
                redirect(pathWeb + "dashboard");
            } else {
                redirect(pathWeb + "usuario/noauth");
            }
            enableBottonForm();
        }, "json")
        .fail(function () {
            mostrarMensajeE(error00);
            enableBottonForm();
        });
    }

    self.recuperarContrasena = function () {
        if ($("#frmPass").valid()) {
            disableBottonForm("frmPass", "btnEnviarRecuperar");
            var url = pathApi + "usuario/apirecordarcontrasena/"
            var usuario = $("#txtUsuarioRecuperar").val();
            $.post(url, { "tipo":"B", usuario: usuario}, function (data) {
                if (data["estatus"]) {
                    mostrarMensajeS(data["mensaje"], "divMensajeSPass", "M");
                } else {
                    mostrarMensajeE(data["mensaje"], "divMensajeEPass", "M");
                }
                enableBottonForm("frmPass", "btnEnviarRecuperar");
            }, "json")
            .fail(function () {
                mostrarMensajeE(error00, "divMensajeEPass", "M");
                enableBottonForm("frmPass", "btnEnviarRecuperar");
            });
        }
    }

    self.cambiarContrasena = function () {
        if ($("#frm").valid()) {
            disableBottonForm();
            var url = pathApi + "usuario/cambiarcontrasenatoken/"
            var contrasena = $("#txtContrasena").val();
            $.post(url, { contrasena: contrasena, param:param }, function (data) {
                if (data["estatus"]) {
                    self.contrasenaCambiada(true);
                    mostrarMensajeS(data["mensaje"]);
                } else {
                    mostrarMensajeE(data["mensaje"]);
                }
                enableBottonForm();
            }, "json")
            .fail(function () {
                mostrarMensajeE(error00);
                enableBottonForm();
            });
        }
    }

    self.mostrarRecuperarContrasena = function () {
        self.logV(false);
        self.passV(true);
    }

    self.mostrarSesion = function () {
        self.logV(true);
        self.passV(false);
    }

    self.mostrarInicioSesion = function () {
        redirect(pathWeb);
    }

}

var sesion = new Sesion();
ko.applyBindings(sesion);