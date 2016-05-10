 <section class="bg-primary" id="padron">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <h2 class="section-heading"><?php echo Texto::idioma("Verifícate consultando el Padrón Electoral");?></h2>
                <h2 class="section-heading"><?php echo Texto::idioma("Conoce tu recinto de votación");?></h2>
                <hr class="light">
                <p class="text-faded"><?php echo Texto::idioma("Así sabrás donde te toca votar en las próximas #Elecciones2016.");?></p>
                <a href="#" class="btn btn-default btn-xl" data-bind="click:app.btnPadron"><?php echo Texto::idioma("Verificate_Ahora");?></a>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalPadron">
  <div class="modal-dialog modal-lg-">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"><?php echo Texto::idioma("Conoce tu recinto de votación");?></h3>
      </div>
      <iframe id="ifPadron" width="100%" height="450" frameborder="0" ></iframe>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->