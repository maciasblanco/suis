<html>
<meta http-equiv="Content-Type" content="text/html" charset="ISO-8859-1"/>
<style type="text/css" src="/web/css/estilo.css"></style>

<style type="text/css">
.center{
    padding-top: 2%;
    text-align: center;   
}

body {
	padding-top: -100%;
  display: block;
  position: relative;
  /*background: url(/html/ev25Y/web/imagenes/fondo.png);*/
  background: url(/html/ev25Y/web/img/logos/logo_mpps_agua_50%.png);
  z-index: -1;    
  background-image-resolution:300dpi;
 background-image-resize:6;
}
.center::after {
  content: "";
	
  position: absolute;
 
  
}
</style>

<body>
<?php
use yii\helpers\Html;
header("Content-Type: text/html; charset=utf-8");
$algo; 
//$filename = Yii::getAlias('@webroot').'/imagenes/zamora.png';

$htmlh ="
<div class='center'>
	<h6><b>Certificados de Nacimiento <span class=\"text-info\">EV-25</span></b></h6>
	<h6><b>Requisito Indispensable para la Formalización del Acta de Nacimiento</b></h6>
	<img src=\"\" height=\"50px\"/>
</div>";


$html = "<table class=\"table table-bordered table-condensed\">
		

		

		
		
		
		
	</table>";
echo $htmlh; 
//echo $html; 

$a = "<table class=\"table table-bordered table-condensed\">
		<tr>
			<td colspan=\"11\"> Nombre del Establecimiento de Salud:</td>
		</tr>
		<tr>
			<td colspan=\"5\"> N° Historia Clinica:</td>
			<td colspan=\"6\">Nacimiento Ocurrido en:</td>
		</tr>
		<tr rowspan=\"2\">
			<td colspan=\"3\">
				<p><h5><small>Lugar de ocurrencia: ENTIDAD: </small> </h5> <h6>{{ENTIDAD}}</h6></p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>MUNICIPIO: </small> </h5><h6>{{MUNICIPIO}}</h6></p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>PARROQUIA: </small> </h5><h6>{{PARROQUIA}}</h6></p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>LOCALIDAD/COMUNIDAD: </small> </h5>{{COMUNIDAD}}</p>
			</td>
		</tr>
		<tr>
			
			<td colspan=\"11\">
				<p><h5><small>DIRECCION: </small> {{DIRECCION}}</h5></p>
			</td>
		</tr>
		<tr>
			<td colspan=\"11\" class=\" center \"> <b> SECCION I. DATOS DEL RECIEN NACIDO </b></td>
		</tr>
		<tr>
			<td colspan=\"4\"><p><h5><small>APELLIDO(S): </small> </h5>
				<h6>{{APELLIDO}}</h6>
			</p></td>
			<td colspan=\"4\"><p><h5><small>NOMBRE(S): </small> </h5>
				<h6>{{NOMBRE}}</h6>
			</p>	</td>
			<td colspan=\"3\"><p><h5><small>FECHA DE NACIMIENTO: </small> </h5>
				<h6>{{11/11/1111}}</h6>
			</p></td>
		</tr>
		<tr>
			<td colspan=\"1\"><p><h5><small>HORA: </small> </h5>
				<h6>{{HORA}}</h6>
			</p></td>
			<td colspan=\"2\"><p><h5><small>SEMANA GESTION: </small> </h5>
				<h6>{{SEMANA}}</h6>
			</p>	</td>
			<td colspan=\"2\"><p><h5><small>PESO: </small> </h5>
				<h6>{{PESO}}</h6>
			</p></td>
			<td colspan=\"1\"><p><h5><small>SEXO: </small> </h5>
				<h6>{{SEXO}}</h6>
			</p></td>
			<td colspan=\"1\"><p><h5><small>TALLA: </small> </h5>
				<h6>{{TALLA}}</h6>
			</p>	</td>
			<td colspan=\"3\"><p><h5><small>MALFORMACION CONGENITA: </small> </h5>
				<h6>{{MALFORMACION}}</h6>
			</p></td>
			<td colspan=\"2\"><p><h5><small>PERIMETRO CEFALICO: </small> </h5>
				<h6>{{PERIMETRO}}</h6>
			</p>	</td>
			
		</tr>
		<tr>
			<td colspan=\"10\" class=\" center \"> <b>SECCION II. DATOS DE LA MADRE</b> </td>
		</tr>	
		<tr>
			<td colspan=\"3\"><p><h5><small>APELLIDO(S): </small> </h5>
				<h6>{{APELLIDO}}</h6>
			</p></td>
			<td colspan=\"3\"><p><h5><small>NOMBRE(S): </small> </h5>
				<h6>{{NOMBRE}}</h6>
			</p>	</td>
			<td colspan=\"3\"><p><h5><small>CEDULA DE IDENTIDAD: </small> </h5>
				<h6>{{CEDULA}}</h6>
			</p></td>
			<td colspan=\"3\"><p><h5><small>SERIAL CARNET LA PATRIA: </small> </h5>
				<h6>{{SERIAL}}</h6>
			</p></td>
		</tr>
		<tr> 
			<td colspan=\"4\"> DIRECCION HABITUAL </td>
		</tr>
		<tr>
			<td colspan=\"3\">
				<p><h5><small>Lugar de ocurrencia: ENTIDAD: </small> </h5>
					<h6>{{ENTIDAD}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>MUNICIPIO: </small> </h5>
					<h6>{{MUNICIPIO}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>PARROQUIA: </small> </h5>
					<h6>{{PARROQUIA}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>LOCALIDAD/COMUNIDAD: </small> </h5>
					<h6>{{LOCALIDAD}}</h6>
				</p>
			</td>
		</tr>
		<tr>
			
			<td colspan=\"12\">
				<p><h5><small>DIRECCION: </small> {{DIRECCION}} </h5></p>
			</td>
		</tr>
		<tr>
			<td colspan=\"3\">
				<p><h5><small>LUGAR DE NACIMIENTO: </small> </h5>
					<h6>{{LUGAR}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>FECHA DE NACIMIENTO: </small> </h5>
					<h6>{{FECHA}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>Edad en años cumplidos al nacer el niño(a): </small> </h5>
					<h6>{{EDAD}}</h6>
				</p>
			</td>
			<td colspan=\"3\"><h5><small>¿Sabe leer y escribir?: </small></h5>
				<h6>{{LEER Y ESCRIBIR}}</h6>
			</td>
			
		</tr>
		<tr>
			<td colspan=\"3\"><h5><small>Situacion conyugal actual: </small> </h5>
			<h6>{{SITUACION}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Años de matrimonio o union: </small> </h5>
				<h6>{{AÑOS}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>N° de hijos (incluyendo el presente): </small> </h5>
				<h6>{{HIJOS}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Durante el embarazo ¿asistio a consulta prenatal?: </small></h5>
				<h6>{{PRENATAL}}</h6>
			</td>

		</tr>
		
		<tr>
			<td colspan=\"3\"><h5><small>Tipo de embarazo: </small> </h5>
			<h6>{{EMBARAZO}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Tipo de parto: </small> </h5>
				<h6>{{PARTO}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Persona que atendio el parto: </small> </h5>
				<h6>{{PERSONA}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Nivel educativo o ultimo año aprobado: </small></h5>
				<h6>{{APROBADO}}</h6>
			</td>
		</tr>
		<tr>
			<td colspan=\"3\"><h5><small>Ocupacion Habitual: </small></h5>
				<h6>{{OCUPACION}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>Profesion: </small></h5>
				<h6>{{PROFESION}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>¿Pertenece usted a alguna Etnia ó Pueblo Indigena?: </small></h5>
				<h6>{{PERTENECE}}</h6>
			</td>
			<td colspan=\"3\"><h5><small>¿Habla usted el idioma de esa Etnia ó Pueblo Indigena?: </small></h5>
				<h6>{{HABLA}}</h6>
			</td>
		</tr>

		<tr>
			<td colspan=\"12\" class=\" center \"> SECCION III. DATOS DEL PADRE </td>
		</tr>	
		<tr>
			<td colspan=\"3\"><p><h5><small>APELLIDO(S): </small> </h5>
				<h6>{{APELLIDOS}}</h6>
			</p></td>
			<td colspan=\"3\"><p><h5><small>NOMBRE(S): </small> </h5>
				<h6>{{NOMBRES}}</h6>
			</p>	</td>
			<td colspan=\"3\"><p><h5><small>CEDULA DE IDENTIDAD: </small> </h5>
				<h6>{{CEDULA}}</h6>
			</p></td>
			<td colspan=\"3\"><p><h5><small>SERIAL CARNET LA PATRIA: </small> </h5>
				<h6>{{CARNET}}</h6>
			</p></td>
		</tr>

		<tr> 
			<td colspan=\"4\"> DIRECCION HABITUAL </td>
		</tr>
		<tr>
			<td colspan=\"3\">
				<p><h5><small>Lugar de ocurrencia: ENTIDAD: </small> </h5>
				<h6>{{ENTIDAD}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>MUNICIPIO: </small> </h5>
					<h6>{{MUNICIPIO}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>PARROQUIA: </small> </h5>
					<h6>{{PARROQUIA}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>LOCALIDAD/COMUNIDAD: </small> </h5>
				<h6>{{LOCALIDAD}}</h6>
				</p>
			</td>
		</tr>
		<tr>			
			<td colspan=\"12\">
				<p><h5><small>DIRECCION: </small> </h5>
					<h6>{{DIRECCION}}</h6>
				</p>
			</td>
		</tr>
		<tr>
			<td colspan=\"3\">
				<p><h5><small>LUGAR DE NACIMIENTO: </small> </h5>
					<h6>{{LUGAR}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>FECHA DE NACIMIENTO: </small> </h5>
					<h6>{{FECHA}}</h6>
				</p>
			</td>
			<td colspan=\"3\">
				<p><h5><small>Edad en años cumplidos al nacer el niño(a): </small> </h5>
					<h6>{{Edad}}</h6>
				</p>
			</td>
			<td colspan=\"3\"><h5><small>¿Sabe leer y escribir?: </small></h5>
				<h6>{{leer}}</h6>
			</td>			
		</tr>
		<tr>
			<td colspan=\"2\"><h5><small>Nivel educativo o ultimo año aprobado: </small></h5>
				<h6>{{educativo}}</h6>
			</td>
			<td colspan=\"2\"><h5><small>Ocupacion Habitual: </small></h5>
				<h6>{{Ocupacion}}</h6>
			</td>
			<td colspan=\"2\"><h5><small>Profesion: </small></h5>
				<h6>{{Profesion}}</h6>
			</td>
			<td colspan=\"2\"><h5><small>¿Pertenece usted a alguna Etnia ó Pueblo Indigena?: </small></h5>
				<h6>{{Etnia}}</h6>
			</td>
			<td colspan=\"2\"><h5><small>¿Habla usted el idioma de esa Etnia ó Pueblo Indigena?: </small></h5>
				<h6>{{¿Habla}}</h6>
			</td>
		</tr>

		<tr>
			<td colspan=\"10\" class=\" center \"> RESPONSABLE DE LA CERTIFICACION </td>		
		</tr>	
		<tr>
			<td colspan=\"3\"><h5><small>APELLIDOS Y NOMBRES DEL MÉDICO(A) </br> RESPONSABLE O PARTERO(A): </small></h5></td>
			<td colspan=\"3\"><h5><small>FIRMA DEL MÉDICO(A) RESPONSABLE <br/> Ó PARTERO(A) Y CEDULA DE IDENTIDAD: </small></h5></td>
			<td colspan=\"2\"><h5><small>MATRICULA DEL MPPS: </small></h5></td>
			<td colspan=\"2\"><h5><small>SELLO DE LA INSTITUCION: </small></h5></td>
			
		</tr>
</table>
";
echo $a;
?>
</body>