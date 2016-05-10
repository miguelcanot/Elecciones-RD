<div class="col-lg-3 col-md-6 text-center mPointer">
    <div class="service-box" data-bind="click:app.mostrarComoVotarBoleta.bind($data, 'A')">
        <i class="fa fa-4x fa-wpforms wow bounceIn text-primary"></i>
        <h3><?php echo Texto::idioma("Boleta_A");?></h3>
        <p class="text-muted"><?php echo Texto::idioma("Nivel_Presidencial");?></p>
    </div>
</div>
<div class="col-lg-3 col-md-6 text-center mPointer">
    <div class="service-box" data-bind="click:app.mostrarComoVotarBoleta.bind($data, 'B')">
        <i class="fa fa-4x fa-wpforms wow bounceIn text-primary" data-wow-delay=".1s"></i>
        <h3><?php echo Texto::idioma("Boleta_B");?></h3>
        <p class="text-muted"><?php echo Texto::idioma("Nivel_Municipal");?></p>
    </div>
</div>
<div class="col-lg-3 col-md-6 text-center mPointer">
    <div class="service-box" data-bind="click:app.mostrarComoVotarBoleta.bind($data, 'C')">
        <i class="fa fa-4x fa-wpforms wow bounceIn text-primary" data-wow-delay=".2s"></i>
        <h3><?php echo Texto::idioma("Boleta_C");?></h3>
        <p class="text-muted"><?php echo Texto::idioma("Nivel_Congresual");?></p>
    </div>
</div>
<!-- wpforms-->
<div class="col-lg-3 col-md-6 text-center mPointer">
    <div class="service-box" data-bind="click:app.mostrarComoVotarBoleta.bind($data, 'D')">
        <i class="fa fa-4x fa-wpforms wow bounceIn text-primary" data-wow-delay=".3s"></i>
        <h3><?php echo Texto::idioma("Boleta_D");?></h3>
        <p class="text-muted"><?php echo Texto::idioma("Voto_Exterior");?></p>
    </div>
</div>

<div class="modal fade" id="modalComoVotar-A">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Formas_Votar_Boleta");?> <i class="fa">A</i></h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">1</i> <?php echo Texto::idioma("Marcando el recuadro del partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca el recuadro del partido de tu preferencia en la boleta A Para elegir Presidente y Vicepresidente.");?></p>
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_1.jpg";?>">
                </div>
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">2</i> <?php echo Texto::idioma("Marcando la foto del candidato presidencial en el recuadro del partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca la foto del candidato de tu preferencia en la boleta A Para elegir Presidente y Vicepresidente.");?></p> 
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_2.jpg";?>">
                </div>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalComoVotar-B">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Formas_Votar_Boleta");?> <i class="fa">B</i></h3>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-xs-12">
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">1</i> <?php echo Texto::idioma("Marcando el recuadro del partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca el recuadro del partido de tu preferencia en la boleta B Para elegir Alcaldes, Vicealcaldes, Suplentes y Regidores.");?></p>
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_3.jpg";?>">
                </div>
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">2</i> <?php echo Texto::idioma("Marcando la foto del candidato a la alcaldía en el recuadro del partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca la foto del candidato de tu preferencia en la boleta B Para elegir Alcaldes, Vicealcaldes, Suplentes y Regidores.");?></p> 
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_4.jpg";?>">
                </div>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalComoVotar-C">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Formas_Votar_Boleta");?> <i class="fa">C</i></h3>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-xs-12">
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">1</i> <?php echo Texto::idioma("Marcando la foto del diputado en el recuadro del partidos de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca la foto del diputado en el recuadro del partido de tu preferencia en la Boleta C, para votar de forma preferencial. El Voto preferencial le cuenta al senador y será válido también para el diputado marcado.");?></p>
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_5.jpg";?>">
                </div>
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">2</i> <?php echo Texto::idioma("Marcando la foto del candidato a senador en el partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca la foto del senador en el recuadro del partido de tu preferencia en la Boleta C. Cuando marcas la foto del senador en la Boleta el voto es no preferencial para los diputados de ese partido.");?></p> 
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_6.jpg";?>">
                </div>
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">3</i> <?php echo Texto::idioma("Marcando el recuadro completo de un partido.");?></h4> 
                    <p><?php echo Texto::idioma("Si Marcas el recuadro de un partido en la Boleta C tu voto cuenta para el senador y es no preferencial para los diputados de ese partido.");?></p> 
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_7.png";?>">
                </div>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modalComoVotar-D">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Formas_Votar_Boleta");?> <i class="fa">D</i></h3>
      </div>
      <div class="modal-body">
       <div class="row">
            <div class="col-xs-12">
                <div class="bs-callout bs-callout-success"> 
                    <h4><i class="fa bg-blue circle">1</i> <?php echo Texto::idioma("Marcando el recuadro del partido de tu preferencia.");?></h4> 
                    <p><?php echo Texto::idioma("Marca el recuadro del partido de tu preferencia en la boleta D. Para elegir Diputados en el exterior.");?></p>
                    <img class="img-responsive" alt="" src="<?php echo IMGDEFAULT."boleta_img_8.png";?>">
                </div>
            </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->