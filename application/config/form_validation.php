<?php

$config = array(
    'sesion' => array(
        array(
                'field' => 'usuario',
                'label' => 'Username',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrasena',
                'label' => 'Password',
                'rules' => 'required|trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'contacto' => array(
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'correo',
                'label' => 'Correo',
                'rules' => 'required|trim|valid_email|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'required|trim|integer|max_length[15]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'mensaje',
                'label' => 'Mensaje',
                'rules' => 'required|trim|min_length[5]|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDpropiedad',
                'label' => 'Propiedad',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDagente',
                'label' => 'Agente',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'buscador' => array(
        array(
                'field' => 'busqueda',
                'label' => 'Busqueda',
                'rules' => 'trim|max_length[50]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'pagina',
                'label' => 'Pagina',
                'rules' => 'required|trim|integer|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'filtroPropiedad' => array(
        array(
                'field' => 'tipo',
                'label' => 'Tipo',
                'rules' => 'trim|max_length[20]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'contrato',
                'label' => 'Contrato',
                'rules' => 'trim|max_length[20]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'precio',
                'label' => 'Precio',
                'rules' => 'trim|max_length[30]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'area',
                'label' => 'Area',
                'rules' => 'trim|max_length[30]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'habitacion',
                'label' => 'Habitacion',
                'rules' => 'trim|max_length[30]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'bano',
                'label' => 'Bano',
                'rules' => 'trim|max_length[30]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'moneda',
                'label' => 'Moneda',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'provincia',
                'label' => 'Provincia',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'ordenadoPor',
                'label' => 'Ordenado_Por',
                'rules' => 'trim|max_length[30]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'url',
                'label' => 'URL',
                'rules' => 'trim|max_length[200]|xss_clean|htmlspecialchars|addslashes'
             ),
        array(
                'field' => 'pagina',
                'label' => 'Pagina',
                'rules' => 'required|trim|integer|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'buscadorImei' => array(
        array(
                'field' => 'imei',
                'label' => 'IMEI',
                'rules' => 'trim|integer|min_length[14]|max_length[16]|xss_clean|htmlspecialchars'
             )
        ),
    'cambiarContrasena' => array(
        array(
                'field' => 'contrasenaAnterior',
                'label' => 'Contrasena_Anterior',
                'rules' => 'required|trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrasena',
                'label' => 'Contrasena_Nueva',
                'rules' => 'required|trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'cambiarContrasenaRecuperada' => array(
        array(
                'field' => 'contrasena',
                'label' => 'Contrasena',
                'rules' => 'required|trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'token',
                'label' => 'Token',
                'rules' => 'required|trim|min_length[1]|max_length[120]|xss_clean|htmlspecialchars'
             )
        ),
    'registrate' => array(
        array(
                'field' => 'correo',
                'label' => 'Correo',
                'rules' => 'trim|required|valid_email|min_length[5]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'apellido',
                'label' => 'Apellido',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrasena',
                'label' => 'Contrasena',
                'rules' => 'required|trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'terminoycondicion',
                'label' => 'Terminos_Y_Condiciones',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'perfil' => array(
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|integer|min_length[9]|max_length[15]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'direccion',
                'label' => 'Direccion',
                'rules' => 'trim|min_length[5]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'celular',
                'label' => 'Celular',
                'rules' => 'trim|integer|min_length[9]|max_length[15]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'apellido',
                'label' => 'Apellido',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fechaNacimiento',
                'label' => 'Fecha_Nacimiento',
                'rules' => 'trim|min_length[10]|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'sexo',
                'label' => 'Sexo',
                'rules' => 'trim|min_length[1]|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'estadoCivil',
                'label' => 'Estado_Civil',
                'rules' => 'trim|min_length[1]|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'compartirCelular',
                'label' => 'Compartir_Celular',
                'rules' => 'required|trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'compartirCorreo',
                'label' => 'Compartir_Correo',
                'rules' => 'required|trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'compartirNombre',
                'label' => 'Compartir_Nombre',
                'rules' => 'trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'bio',
                'label' => 'Bio',
                'rules' => 'trim|max_length[500]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'url',
                'label' => 'URL',
                'rules' => 'trim|min_length[2]|max_length[300]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'confirmarContrasena',
                'label' => 'Confirmar_Contrasena',
                'rules' => 'trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrasenaAnterior',
                'label' => 'Contrasena_Anterior',
                'rules' => 'trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrasena',
                'label' => 'Contrasena_Nueva',
                'rules' => 'trim|min_length[6]|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'preferenciaRespuesta' => array(
        array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'opcion',
                'label' => 'Opcion',
                'rules' => 'required|trim|max_length[2]|xss_clean|htmlspecialchars'
             )
        ),
    'equipoModificar' => array(
        array(
                'field' => 'IDequipo',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'marca',
                'label' => 'Marca',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'modelo',
                'label' => 'Modelo',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'imei',
                'label' => 'IMEI',
                'rules' => 'required|trim|numeric|min_length[14]|max_length[16]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'pais',
                'label' => 'Pais',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'ciudad',
                'label' => 'Ciudad',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'recompensa',
                'label' => 'Recompensa',
                'rules' => 'trim|numeric|max_length[11]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'estatus',
                'label' => 'Estatus',
                'rules' => 'required|trim|max_length[2]|xss_clean|htmlspecialchars'
             )
        ),
    'eliminarEquipo' => array(
        array(
                'field' => 'IDequipo',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             )
        ),
    'verDetalleEquipo' => array(
        array(
                'field' => 'IDequipo',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             )
        ),
    'rol' => array(
        array(
                'field' => 'IDrol',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|max_length[1000]|xss_clean|htmlspecialchars'
             )
        ),
    'rolEliminar' => array(
        array(
                'field' => 'IDrol',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'rolObjeto' => array(
        array(
                'field' => 'IDrol',
                'label' => 'Rol',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDobjeto',
                'label' => 'Objeto',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'recordarContrasena' => array(
        array(
                'field' => 'usuario',
                'label' => 'Usuario',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'configuracion' => array(
        array(
                'field' => 'empresa',
                'label' => 'Empresa',
                'rules' => 'required|trim|max_length[300]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'eslogan',
                'label' => 'Eslogan',
                'rules' => 'trim|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'direccion',
                'label' => 'Direccion',
                'rules' => 'trim|max_length[300]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fax',
                'label' => 'Fax',
                'rules' => 'trim|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|valid_emial|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'email_envio',
                'label' => 'Email_Envio',
                'rules' => 'trim|valid_emial|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'clave',
                'label' => 'Contrasena',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'host',
                'label' => 'Host',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'puerto',
                'label' => 'Puerto',
                'rules' => 'trim|integer|max_length[5]|xss_clean|htmlspecialchars'
             )
        ),
    'social' => array(
        array(
                'field' => 'IDsocial',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'id',
                'label' => 'ID',
                'rules' => 'trim|max_length[500]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'access_token',
                'label' => 'Access_Token',
                'rules' => 'trim|max_length[500]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'access_token_secret',
                'label' => 'Access_Token_Secret',
                'rules' => 'trim|max_length[500]|xss_clean|htmlspecialchars'
             )
        ),
    'usuario' => array(
        array(
                'field' => 'IDusuario',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'apellido',
                'label' => 'Apellidp',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'usuario',
                'label' => 'Usuario',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'correo',
                'label' => 'Correo',
                'rules' => 'required|trim|valid_email|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'comentario',
                'label' => 'Comentario',
                'rules' => 'trim|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'agente',
                'label' => 'Agente',
                'rules' => 'required|trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             )
        ),
    'usuarioEliminar' => array(
        array(
                'field' => 'IDusuario',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'objeto' => array(
        array(
                'field' => 'IDobjeto',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre_logico',
                'label' => 'Nombre_Logico',
                'rules' => 'required|trim|max_length[200]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre_fisico',
                'label' => 'Nombre_Fisico',
                'rules' => 'required|trim|max_length[300]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'tipo_objeto',
                'label' => 'Tipo_Objeto',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDobjeto_relacionado',
                'label' => 'Objeto_Relacionado',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'objetoEliminar' => array(
        array(
                'field' => 'IDobjeto',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'color' => array(
        array(
                'field' => 'IDcolor',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'colorEliminar' => array(
        array(
                'field' => 'IDcolor',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'marca' => array(
        array(
                'field' => 'IDmarca',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'marcaEliminar' => array(
        array(
                'field' => 'IDmarca',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'contactoEliminar' => array(
        array(
                'field' => 'IDmensaje_contacto',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'usuarioEspecialidad' => array(
        array(
                'field' => 'IDespecialidad',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        ),
    'experiencia' => array(
        array(
                'field' => 'IDexperiencia',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'lugar',
                'label' => 'Lugar',
                'rules' => 'required|trim|max_length[200]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fecha_inicio',
                'label' => 'Fecha_Inicio',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fecha_fin',
                'label' => 'Fecha_Fin',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'area',
                'label' => 'Area',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'puesto',
                'label' => 'Puesto',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'duracion',
                'label' => 'Duracion',
                'rules' => 'required|trim|integer|max_length[4]|xss_clean|htmlspecialchars'
             )
        ),
    'estudio' => array(
        array(
                'field' => 'IDestudio',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'institucion',
                'label' => 'Institucion',
                'rules' => 'required|trim|max_length[200]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fecha_inicio',
                'label' => 'Fecha_Inicio',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fecha_fin',
                'label' => 'Fecha_Fin',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'grado',
                'label' => 'Grado',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'tipo_documento',
                'label' => 'Tipo_Documento',
                'rules' => 'required|trim|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'compartir',
                'label' => 'Compartir',
                'rules' => 'required|trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             )
        ),
    'paciente' => array(
        array(
                'field' => 'IDpaciente',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'apellido',
                'label' => 'Apellido',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'fecha_fin',
                'label' => 'Fecha_Fin',
                'rules' => 'trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'expediente',
                'label' => 'Expediente',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|integer|min_length[10]|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'Celular',
                'label' => 'Celular',
                'rules' => 'trim|integer|min_length[10]|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'compartir',
                'label' => 'Compartir',
                'rules' => '|trim|integer|min_length[1]|max_length[1]|xss_clean|htmlspecialchars'
             )
        ),
    'consultorio' => array(
        array(
                'field' => 'IDconsultorio',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'piso',
                'label' => 'Piso',
                'rules' => 'required|trim|integer|max_length[3]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'numero',
                'label' => 'Numero',
                'rules' => 'rquired|trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|integer|min_length[10]|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'extension',
                'label' => 'Extension',
                'rules' => 'trim|integer|min_length[0]|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'horario',
                'label' => 'Horario',
                'rules' => 'trim|max_length[200]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDpais',
                'label' => 'Pais',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'ciudad',
                'label' => 'Ciudad',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'direccion',
                'label' => 'Direccion',
                'rules' => 'trim|max_length[300]|xss_clean|htmlspecialchars'
             )
        ),
    'asistente' => array(
        array(
                'field' => 'IDasistente',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'apellido',
                'label' => 'Apellidp',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'usuario',
                'label' => 'Usuario',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'correo',
                'label' => 'Correo',
                'rules' => 'trim|valid_email|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'telefono',
                'label' => 'Telefono',
                'rules' => 'trim|integer|min_length[9]|max_length[15]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'celular',
                'label' => 'Celular',
                'rules' => 'trim|integer|min_length[9]|max_length[15]|xss_clean|htmlspecialchars'
             )
        ),
    'propiedad' => array(
        array(
                'field' => 'IDpropiedad',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'tipo',
                'label' => 'Tipo',
                'rules' => 'required|trim|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'contrato',
                'label' => 'Contrato',
                'rules' => 'required|trim|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDpais',
                'label' => 'Pais',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDprovincia',
                'label' => 'Provincia',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'ciudad',
                'label' => 'Ciudad',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'precio',
                'label' => 'Precio',
                'rules' => 'required|trim|max_length[16]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'codigo',
                'label' => 'Codigo',
                'rules' => 'trim|max_length[20]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDmoneda',
                'label' => 'Moneda',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'area',
                'label' => 'Area',
                'rules' => 'required|trim|max_length[9]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'area_solar',
                'label' => 'Area_Solar',
                'rules' => 'required|trim|max_length[9]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'bano',
                'label' => 'Bano',
                'rules' => 'trim|min_length[1]|max_length[4]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'estacionamiento',
                'label' => 'Estacionamiento',
                'rules' => 'trim|integer|min_length[1]|max_length[4]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'habitacion',
                'label' => 'Habitacion',
                'rules' => 'trim|integer|min_length[1]|max_length[4]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|max_length[8000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'lat',
                'label' => 'Latitud',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'lng',
                'label' => 'Longitud',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'moneda' => array(
        array(
                'field' => 'IDmoneda',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'abreviatura',
                'label' => 'Abreviatura',
                'rules' => 'required|trim|max_length[10]|xss_clean|htmlspecialchars'
             )
        ),
    'caracteristica' => array(
        array(
                'field' => 'IDcaracteristica',
                'label' => 'ID',
                'rules' => 'trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'postSocialConfig' => array(
        array(
                'field' => 'Tipo',
                'label' => 'Tipo',
                'rules' => 'required|trim|min_length[1]|max_length[2]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'Descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'planCaracteristica' => array(
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'required|trim|min_length[2]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'IDplan',
                'label' => 'Plan',
                'rules' => 'required|trim|min_length[1]|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'denuncia' => array(
        array(
                'field' => 'IDRecinto',
                'label' => 'Recinto',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'Mesa',
                'label' => 'Mesa',
                'rules' => 'trim|max_length[10]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'Denunciante',
                'label' => 'Denunciante',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'Comentario',
                'label' => 'Comentario',
                'rules' => 'trim|max_length[500]|xss_clean|htmlspecialchars'
             )
        ),
    'aplicacion' => array(
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'trim|required|min_length[1]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'descripcion',
                'label' => 'Descripcion',
                'rules' => 'trim|min_length[0]|max_length[1000]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'web',
                'label' => 'Web',
                'rules' => 'trim|min_length[0]|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'callback_url',
                'label' => 'Callback_URL',
                'rules' => 'required|trim|min_length[1]|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'suscripcion' => array(
        array(
                'field' => 'nombre',
                'label' => 'Nombre',
                'rules' => 'trim|max_length[100]|xss_clean|htmlspecialchars'
             ),
        array(
                'field' => 'correo',
                'label' => 'Correo',
                'rules' => 'required|trim|max_length[100]|xss_clean|htmlspecialchars'
             )
        ),
    'id' => array(
        array(
                'field' => 'ID',
                'label' => 'ID',
                'rules' => 'required|trim|xss_clean|htmlspecialchars'
             )
        )                        
    );
?>