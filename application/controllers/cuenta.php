<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	class Cuenta extends MY_Controller {

		public function index() {
			$this->usuarioLogueado();
			$this->usuarioPermiso(array(1));
			$dato['titulo'] = Texto::idioma('Administrar_Cuenta', IDIOMA);
			$dato['vista'] = 'cuenta/administrar';
			$dato['baseUrl'] = base_url();
			$this->load->model("ModeloCuenta");
			$usuario = $this->session->userdata("sUsuario");
			$dato['mensaje'] = Texto::idioma('');
			$dato['listaCuenta'] = $this->ModeloCuenta->obtenerCuentaUsuario($usuario["id"]);
			$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
		}
		
		public function registrar() {
			$this->usuarioLogueado();
			$this->usuarioPermiso(array(1));
			$dato['menuS'] = "mAdmin";
			$dato['titulo'] = Texto::idioma('Registrar_Cuenta', IDIOMA);
			$dato['subTitulo'] = Texto::idioma('', IDIOMA);
			$this->load->model("ModeloCuenta");
			if($this->input->post('txtNombre')){
				$estatus = 'A';
				$idTipoCuenta = Encryption::decode($this->input->post('drpdTipoCuenta'));
				$nombre = trim($this->input->post('txtNombre'));
				$usuario = $this->session->userdata("sUsuario");
				$cuenta = new EntCuenta(0, $usuario["id"], $nombre, $idTipoCuenta, "", "", "", 1, $estatus, "");
				$this->ModeloCuenta->registrar($cuenta);
				redirect('cuenta');
			} else {
				$dato['vista'] = 'cuenta/registrar';
				$this->load->model("ModeloCuenta");
				$dato['listaTipoCuenta'] = $this->ModeloCuenta->obtenerTipoCuentaActiva(true);
				$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
			}
		}

	public function modificar($id = "", $mensaje = ""){
		$this->usuarioLogueado();
		$this->usuarioPermiso(array(1));
		$dato['menuS'] = "mAdmin";
		$dato['mensaje'] = $mensaje;
		$dato['idCuenta'] = $id;
		if ($id != "") {
			$id = Encryption::decode($id);
			$dato['titulo'] = Texto::idioma('Modificar_Cuenta', IDIOMA);
			$dato['subTitulo'] = Texto::idioma('', IDIOMA);
			$this->load->model("ModeloCuenta");
			$usuario = $this->session->userdata("sUsuario");
			if($this->input->post('drpdTipoCuenta')){
				$nombre = trim($this->input->post('txtNombre'));
				$idCuenta = Encryption::decode($this->input->post('txtCuenta'));
				$estatus = 'A';
				$idTipoCuenta = Encryption::decode($this->input->post('drpdTipoCuenta'));
				$cuenta = new EntCuenta($idCuenta, $usuario["id"], $nombre, $idTipoCuenta, "", "", "", 1, $estatus, "");
				$this->ModeloCuenta->actualizarDatosCuenta($cuenta);
				redirect('cuenta');
			}  else {
				$dato['vista'] = 'cuenta/modificar';
				$dato['cuenta'] = $this->ModeloCuenta->obtenerCuentaPorIdCuentaIdUsuario($id, $usuario['id'], true);
				if ($dato['cuenta']->getIdCuenta() != '') {
					$dato['listaTipoCuenta'] = $this->ModeloCuenta->obtenerTipoCuentaActiva(true);
					$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
				} else {
					redirect();
				}
			}
		} else {
			redirect();
		}
	}
	}
?>