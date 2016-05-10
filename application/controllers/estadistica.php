<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
	class Estadistica extends MY_Controller {
		
		public function index(){
			$this->auth("estadistica");
			$dato['menuS'] = "mAdmin";
			$dato['titulo'] = Texto::idioma('Dashboard');
			$dato['subTitulo'] = Texto::idioma('');
			$dato['baseUrl'] = base_url();
			$dato['vista'] = 'estadistica/resumenestadistica';
			$this->load->view(TEMADEFAULTADMIN.'admin', $dato);
		}
		
		public function d() {
			//$this->auth("estadistica");
			$dato['menuS'] = "mEstadistica";
			$dato['titulo'] = Texto::idioma('Estadisticas');
			$dato['subTitulo'] = Texto::idioma('');
			$dato['baseUrl'] = base_url();
			$dato['vista'] = 'estadistica/listado';
			$this->load->view(TEMADEFAULT.'general', $dato);
		}

		private function genDonut($listado, $nombreSerie = ''){
			$nombreSerie = Texto::idioma($nombreSerie);
			$res = "";
			foreach ($listado as $valor) {
				$res .= ($res == "") ? "" : ", ";
				$res .= "{
                	label: '{$valor['descripcion']}',
                	value: {$valor['valor']}
            	}";
			}
			return $res;
		}

		private function genSeriesLinea($data, $nombreSerie = ''){
			$nombreSerie = Texto::idioma($nombreSerie);
			$res = "{";
			$res .= "name: '{$nombreSerie}', data: [";
			foreach ($data as $nombre => $valor) {
				$res .= "$valor,";
			}
			$res=substr($res,0, -1);
			$res .= "]}";
			return $res;
		}

		private function genSeriesPastel($descripcion,$data){
			$res = "{";
			$res .= "type: 'pie',name: '$descripcion', data: [";
			foreach ($data as $nombre => $valor) {
				$res .= "['$nombre',   $valor],";
			}
			$res=substr($res,0, -1);
			$res .= "]}";
			return $res;
		}
		
		public function index2() {
			$this->usuarioLogueado();
			$this->usuarioPermiso(array(1, 2));
			$dato['titulo'] = Texto::idioma('Panel_Estadistica', IDIOMA);
			$dato['vista'] = 'estadistica/resumenestadistica';
			$dato['baseUrl'] = base_url();
			$usuario = $this->session->userdata("sUsuario");
			$dato['idRol'] = $usuario['idRol'];
			$dato['menuS'] = "mAdmin";
			$this->load->model("ModeloCuestionario");
			$lista = $this->ModeloCuestionario->obtenerGraficoProvincia();
			
			
			$dato['serieProvincia'] = $this->genSeriesPastel(Texto::idioma("Encuestado_Por_Provincia"), $lista);
			
			$this->load->view(TEMADEFAULT.'admin', $dato);
		}
		
		public function g($tipo = '') {
			$this->usuarioLogueado();
			$this->usuarioPermiso(array(1));
			$usuario = $this->session->userdata("sUsuario");
			$dato['titulo'] = Texto::idioma('Estadistica', IDIOMA);
			if ($tipo == "p") {
				$this->load->model("ModeloCuestionario");
				$lista = $this->ModeloCuestionario->obtenerGraficoProvincia();
				$dato['vista'] = 'estadistica/lineal';
				$dato['categoria'] = implode("','", array_keys($lista));
				$dato['serie'] = $this->genSeriesLinea(array_values($lista), "Cantidad");
				$dato['ejeY'] = Texto::idioma('Cantidad');
				$dato['tituloGrafico'] = Texto::idioma('Encuestado_Por_Provincia');
				$dato['subTituloGrafico'] = Texto::idioma('');
			} else if ($tipo == "e") {
				$this->load->model("ModeloCuestionario");
				$lista = $this->ModeloCuestionario->obtenerGraficoEdad();
				$dato['vista'] = 'estadistica/lineal';
				$dato['categoria'] = implode("','", array_keys($lista));
				$dato['serie'] = $this->genSeriesLinea(array_values($lista), "Resultado");
				$dato['ejeY'] = Texto::idioma('Resultado');
				$dato['tituloGrafico'] = Texto::idioma('Resultado_Por_Edad');
				$dato['subTituloGrafico'] = Texto::idioma('');
			} else if ($tipo == "pe") {
				$this->load->model("ModeloCuestionario");
				$lista = $this->ModeloCuestionario->obtenerGraficoPromedioEdad();
				$dato['vista'] = 'estadistica/lineal';
				$dato['categoria'] = implode("','", array_keys($lista));
				$dato['serie'] = $this->genSeriesLinea(array_values($lista), "Resultado_Promedio_Edad");
				$dato['ejeY'] = Texto::idioma('Resultado');
				$dato['tituloGrafico'] = Texto::idioma('Resultado_Promedio_Edad');
				$dato['subTituloGrafico'] = Texto::idioma('');
			}
			$this->load->view(TEMADEFAULT.'admin', $dato);
			
		}
		
		public function apiObtenerEstadistica() {
			$this->authApi("estadistica/consulta");
			$this->load->model("ModeloDenuncia");
			$denuncia = $this->ModeloDenuncia->obtenerCantidadDenuncia();
			$this->load->model("ModeloPostSocial");
			$publicacion = $this->ModeloPostSocial->obtenerCantidadPostSocial();
			echo json_encode(array("estatus"=>true, "denuncia"=>$denuncia, "publicacion"=>$publicacion));
		}
	}
?>