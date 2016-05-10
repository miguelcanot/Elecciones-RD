<?php
	function pageNavi($post = "", $pagina = 0) {
		$pagina = ($pagina < 2) ? 0 : $pagina - 1;;
		$listaContenido = explode("<!--nextpage-->", $post["body"]);
		$paginacion = '<nav><ul class="pagination">';
		$paginaAnterior = $pagina;
		$paginaSiguiente = $pagina + 2;
	    $paginacion .= ($pagina > 0) ? '<li><a href="'.base_url()."d/".$post["id"]."/{$paginaAnterior}".'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>' : "";
	    if (count($listaContenido) > 1) {
			foreach ($listaContenido as $key => $cuerpo) {
				$index = $key + 1;
				$activo = ($pagina == $key) ? "active" : "";
				$url = base_url()."d/".$post["id"]."/{$index}";
				$paginacion .= "<li class='{$activo}'><a href='{$url}'><span>{$index} </span></a></li>";
			}
		}
		$paginacion .= ($pagina != (count($listaContenido) - 1)) ? '<li><a href="'.base_url()."d/".$post["id"]."/{$paginaSiguiente}".'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' : "";
		$paginacion .= '</ul></nav>';
	    return $paginacion;	
	}
?>