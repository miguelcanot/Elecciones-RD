<div class="div_reg" style="visibility: visible; height: 260px; width: 310px; ">
        <form action="<?php echo HOST."user/login";?>" class="login" method="post">
            <h1 class="h1"><?php echo Texto::idioma("Sign In", IDIOMA);?> </h1>
            <fieldset class="row5">
                <legend><?php echo Texto::idioma("Login", IDIOMA);?>
                </legend>
                <p>
                    <label><?php echo Texto::idioma("Login*", IDIOMA);?>
                  </label>
                    <input type="text" name="txtUsername"/>
                    <label><?php echo Texto::idioma("Password *", IDIOMA);?>
                    </label>
                    <input type="password" name="txtPassword"/>
                </p>
            </fieldset>
            <div><button class="button"><?php echo Texto::idioma("Login x", IDIOMA);?></button></div>
        </form>
</div>