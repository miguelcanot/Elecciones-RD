<div class="col-xs-12" data-bind="foreach:listaPostSocial">
    <!-- Message. Default to the left -->
    
      <div class="direct-chat-msg mPointer" data-bind="click:postSocial.verPostP">
        <div class="direct-chat-info clearfix">
          <span class="direct-chat-name pull-left" data-bind="html:Usuario"></span>
          <span class="direct-chat-timestamp pull-right" data-bind="html:Fecha"></span>
        </div><!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="" data-bind="attr:{src:Imagen}" alt=""><!-- /.direct-chat-img -->
        <div class="direct-chat-text" data-bind="html:Cuerpo"></div><!-- /.direct-chat-text -->
      </div><!-- /.direct-chat-msg -->
    
    <!-- ko if: $index() % 2 > 999 -->
      <!-- Message to the right -->
      <div class="direct-chat-msg right mPointer">
        <div class="direct-chat-info clearfix">
          <span class="direct-chat-name pull-right" data-bind="html:Usuario"></span>
          <span class="direct-chat-timestamp pull-left" data-bind="html:Fecha"></span>
        </div><!-- /.direct-chat-info -->
        <img class="direct-chat-img" src="" data-bind="attr:{src:Imagen}" alt=""><!-- /.direct-chat-img -->
        <div class="direct-chat-text" data-bind="html:Cuerpo"></div><!-- /.direct-chat-text -->
      </div>
      <!-- /ko -->
</div>

<!-- Loading (remove the following to stop the loading)-->
<div class="overlay invisible" id="lPostSocial">
  <i class="fa fa-refresh fa-spin"></i>
</div>
<!-- end loading -->
<script src="<?php echo VIEWMODEL;?>postsocial.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		ko.applyBindings(postSocial, $("#divVista").get(0));
		postSocial.obtenerPublicacion();
    });
</script>