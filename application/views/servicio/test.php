<form name="ctl00" method="post" action="http://www.minerd.gob.do/sitesee.net/consulta_prueba_nac/Consulta.aspx" id="ctl00">
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="">
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="">
<input type="hidden" name="__LASTFOCUS" id="__LASTFOCUS" value="">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTIxMjM2NDAxNzQPZBYEZg9kFgQCAQ8WAh4HVmlzaWJsZWhkAgMPFgIfAGcWBgIFDxAPFggeCkRhdGFNZW1iZXIFBGRhdGEeDkRhdGFWYWx1ZUZpZWxkBQtwZXJpX2NvZGlnbx4NRGF0YVRleHRGaWVsZAUQcGVyaV9kZXNjcmlwY2lvbh4LXyFEYXRhQm91bmRnZBAVGB5QRVJJT0RPIDIwMTUgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAyMDE0ICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMjAxMyAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDIwMTIgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAyMDExICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMjAxMCAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDIwMDkgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAyMDA4ICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMjAwNyAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDIwMDYgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAyMDA1ICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMjAwNCAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDIwMDMgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAyMDAyICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMjAwMSAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDIwMDAgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAxOTk5ICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMTk5OCAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDE5OTcgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAxOTk2ICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMTk5NSAgICAgICAgICAgICAgICAgIB5QRVJJT0RPIDE5OTQgICAgICAgICAgICAgICAgICAeUEVSSU9ETyAxOTkzICAgICAgICAgICAgICAgICAgHlBFUklPRE8gMTk5MiAgICAgICAgICAgICAgICAgIBUYBDIwMTUEMjAxNAQyMDEzBDIwMTIEMjAxMQQyMDEwBDIwMDkEMjAwOAQyMDA3BDIwMDYEMjAwNQQyMDA0BDIwMDMEMjAwMgQyMDAxBDIwMDAEMTk5OQQxOTk4BDE5OTcEMTk5NgQxOTk1BDE5OTQEMTk5MwQxOTkyFCsDGGdnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZxYBZmQCBw8QDxYIHwEFBGRhdGEfAgULY29udl9jb2RpZ28fAwUJY29udl9kZXNjHwRnZBAVAQExFQEBMRQrAwFnZGQCCQ8PZBYCHglvbmtleWRvd24FFmZuVHJhcEtEKGJ1c2NhcixldmVudClkAgEPFgIeCWlubmVyaHRtbAUXPGZvbnQgY29sb3I9cmVkPjwvZm9udD5kZDiADzpJtywo+PqzSX2nwsUdapzn">
</div>

<script type="text/javascript">
//<![CDATA[
var theForm = document.forms['ctl00'];
if (!theForm) {
    theForm = document.ctl00;
}
function __doPostBack(eventTarget, eventArgument) {
    if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
        theForm.__EVENTTARGET.value = eventTarget;
        theForm.__EVENTARGUMENT.value = eventArgument;
        theForm.submit();
    }
}

function enviar() {

	    
	    $.ajax({
	        type: "POST",
	        url: "http://www.minerd.gob.do/sitesee.net/consulta_prueba_nac/Consulta.aspx",
	        data: $("#ctl00").serialize(), // Adjuntar los campos del formulario enviado.
	        success: function (data) {
	            redirect(pathWeb + "departamento");
	        },
	        error: function (data, errorThrown) {
	            mostrarMensajeE(data.responseText);
	            enableBottonForm();
	        }
	    });
	    return false;

}


//]]>
</script>


<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="69CC9898">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWHQKQn8fJCALejcXUBwKVocPfAQLWtsSKDwLWttjvBgLWtuzUAQLWtoC5CQLWtpQeAta2qMMLAr2PmtoMAr2Prr8EAr2PgtYCAr2PlrsKAr2PquAFAr2PvsUMAr2P0qkEAr2P5o4PAr2P+vMGAr2PjtgBAvns564EAvns+5MPAvnsz6oKAvns448FAvns9/QMAvnsi9kHAvnsn74PAvnss+MGAo2Sj+sPAuyjqYwPJ8992ZpkbhyLRisgNrgM/X6e0e0=">
</div>
    
    <div id="cons" align="center">
        <table id="AutoNumber1" style="border-collapse: collapse" bordercolor="#111111" cellspacing="0" cellpadding="0" width="100%" border="0">
            <tbody>
                <tr>
                    <td>
                        <div align="center">
                            <center>
                                <!--<h2>
                                    Consulta disponible hasta el
                                    <span id="lblperiodo"></span></h2>-->
                                <table class="MantForm" style="border-collapse: collapse" bordercolor="#111111" cellspacing="0" cellpadding="0" border="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table cellspacing="0" cellpadding="0" border="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="OpcTopMenu" nowrap="nowrap" align="middle" colspan="2">
                                                                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="OpcTopMenu" valign="center" nowrap="nowrap">
                                                                                Condición RNE
                                                                            </td>
                                                                            <td valign="center" align="right">
                                                                                &nbsp;
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr class="ColDetail">
                                                            <td style="border-right: 1px solid; border-top: 1px solid; border-left: 1px solid;
                                                                border-bottom: 1px solid" valign="top" nowrap="nowrap">
                                                                <input type="submit" name="buscar" value="Buscar" id="buscar" title="Buscar Información según Criterios" class="myButtom">
                                                            </td>
                                                            <td align="middle">
                                                                <!-- Generado -->
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td valign="top" nowrap="nowrap" align="right">
                                                                                <strong>Año Escolar</strong>
                                                                            </td>
                                                                            <td nowrap="nowrap">
                                                                                &nbsp;<select name="busPeriCodigo" onchange="javascript:setTimeout('__doPostBack(\'busPeriCodigo\',\'\')', 0)" id="busPeriCodigo">
	<option  value="2015">PERIODO 2015                  </option>
	<option value="2014">PERIODO 2014                  </option>
	<option value="2013">PERIODO 2013                  </option>
	<option value="2012">PERIODO 2012                  </option>
	<option value="2011">PERIODO 2011                  </option>
	<option value="2010">PERIODO 2010                  </option>
	<option value="2009">PERIODO 2009                  </option>
	<option selected="selected" value="2008">PERIODO 2008                  </option>
	<option value="2007">PERIODO 2007                  </option>
	<option value="2006">PERIODO 2006                  </option>
	<option value="2005">PERIODO 2005                  </option>
	<option value="2004">PERIODO 2004                  </option>
	<option value="2003">PERIODO 2003                  </option>
	<option value="2002">PERIODO 2002                  </option>
	<option value="2001">PERIODO 2001                  </option>
	<option value="2000">PERIODO 2000                  </option>
	<option value="1999">PERIODO 1999                  </option>
	<option value="1998">PERIODO 1998                  </option>
	<option value="1997">PERIODO 1997                  </option>
	<option value="1996">PERIODO 1996                  </option>
	<option value="1995">PERIODO 1995                  </option>
	<option value="1994">PERIODO 1994                  </option>
	<option value="1993">PERIODO 1993                  </option>
	<option value="1992">PERIODO 1992                  </option>

</select>
                                                                                &nbsp;&nbsp;&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" nowrap="nowrap" align="right">
                                                                                <strong>Convocatoria</strong>
                                                                            </td>
                                                                            <td nowrap="nowrap">
                                                                                &nbsp;<select name="busConvCodigo" id="busConvCodigo">
	<option value="1">1</option>

</select>
                                                                                &nbsp;&nbsp;&nbsp;
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td valign="top" nowrap="nowrap" align="right">
                                                                                <strong>Código de Estudiante (RNE o NUMERO DE REGISTRO)</strong>
                                                                            </td>
                                                                            <td nowrap="nowrap">
                                                                                &nbsp;<input name="busMrneCodigo" type="text" id="busMrneCodigo" onkeydown="fnTrapKD(buscar,event)">
                                                                                &nbsp;&nbsp;&nbsp;
                                                                            </td>
                                                                        </tr>
																		<tr>
																			<td colspan="2" style="width:400px;padding-top:10px;">
																				<strong>Nota: Para consultar las notas de Pruebas Nacionales puede realizarlo con el RNE o NUMERO DE REGISTRO.</strong>
																			</td>
																		</tr>
                                                                    </tbody>
                                                                </table>
                                                                <!-- Final Generado -->
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </center>
                        </div>
                        <br>
                    </td>
                </tr>
            </tbody>
        </table>
        <table cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td align="middle">
                        <div class="OpcParMenu" id="divResult">
                            <table cellspacing="0" cellpadding="0" border="0">
                                <tbody>
                                    <tr>
                                        <td align="middle">
                                            <!-- Generado -->
                                            <div id="divTablas">
                                            </div>
                                            <!-- Final de Generado -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
<script language="javascript">
      <!--
      function fnTrapKD(btn, event){        if (document.all){          if (event.keyCode == 13){            event.returnValue=false;            event.cancel = true;            btn.click();          }        }        else if (document.getElementById){          if (event.which == 13){            event.returnValue=false;            event.cancel = true;            btn.click();          }        }        else if(document.layers){          if(event.which == 13){            event.returnValue=false;            event.cancel = true;            btn.click();          }        }      }
      function hoja_respuesta(asig_codigo){        window.open('spn_dbimages.aspx?peri_codigo=' + document.forms[0].busPeriCodigo.value + '&conv_codigo=' + document.forms[0].busConvCodigo.value + '&mrne_codigo=' + document.forms[0].busMrneCodigo.value + '&asig_codigo=' + asig_codigo);      }
      // -->
      </script>
</form>