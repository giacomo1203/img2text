<html>
  <head>
    <meta charset="UTF-8">
  <title>RENDER</title>


 <style>
   .table td{
		 padding: 5px;
		 font-family: verdana;
		 font-size: 12px;
   }
    body h1{
	    font-family: verdana,arial,sans-serif;
    }
	table.gridtable {
		font-family: verdana,arial,sans-serif;
		font-size:11px;
		color:#333333;
		border-width: 1px;
		border-color: #BEBEBE;
		border-collapse: collapse;
		border-radius: 8px;
	}
	table.gridtable th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #BEBEBE;
		background-color: #EBEBEB;
		text-align: right;
	}
	table.gridtable td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #BEBEBE;
		background-color: #ffffff;
	}
	table.gridtable input[type="text"],select,input[type="file"]{
		background: #F8F8F8;
		padding: 3px;
		border: 1px solid #C3C3C3;
		border-radius: 3px;
		width: 220px;
	}
	table.gridtable input[type="submit"]{
		padding: 5px;
	}
   .tip{
	 color: #32688F;
	 margin-left: 10px;
   }
 </style>
</head>

 <body>
    <center>
		<h1>IMAGEN TEXTO</h1>
		<form name="convert" method="POST" action="render.php" enctype="multipart/form-data">
		  <table width="60%" border="0" cellspacing="0" cellpadding="0" class="gridtable">
		    <tbody><tr>
			  <th width="20%"> Subir imagen: </th>
			  <td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Texto o letras:</th>
				<td>
          <textarea rows="4" cols="50" name="characters" value="0"></textarea>
          <span class="tip">(Pegar texto a renderizar)</span></td>
			</tr>
			<tr>
				<th>Tamaño de image :</th>
				<td>
					<select name="fontsize" id="fontsize">
						<option value="10">Pequeña</option>
						<option selected="selected" value="12">Normal</option>
						<option value="14">Grande</option>
					</select><span class="tip">(Normal 12px)</span>
				</td>
			</tr>
			<tr>
				<th>Color</th>
				<td>
					<select name="img_type">
						<option selected="selected" value="color">Color</option>
						<option value="gray">Escala de grises</option>
					</select><span class="tip">(Salida de color)</span>
				</td>
			</tr>
			<tr>
				<th>Color de fondo</th>
				<td><input type="text" name="bgcolor" value="black"><span class="tip">(Si la imagen es clara, es recomendable usar fondo negro)</span></td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input type="submit" value="Renderizar"></td>
			</tr>



</tbody></table></form></center></body></html>
