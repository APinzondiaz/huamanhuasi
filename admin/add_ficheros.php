<?php 
	require_once('cusuario.php');

	if(isset($_REQUEST["buscar"])){
		$buscar=$_REQUEST["buscar"];
	}
	else{
		$buscar="";
	}
	?>
<!doctype html>
<html lang="en-US" xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:addthis="https://www.addthis.com/help/api-spec"  prefix="og: http://ogp.me/ns#" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Administrar ficheros</title>
	
	<link rel="shortcut icon" href="https://demo.learncodeweb.com/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
		google_ad_client: "ca-pub-6724419004010752",
		enable_page_level_ads: true
	  });
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131906273-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-131906273-1');
	</script>
</head>
<body>
	
		
	<?php 
		include_once('cabecera.php');

	?>


   	<div class="container">
		<div class="card">
			<div class="card-header"><i class="fa fa-fw fa-download"></i> <strong>Administrar ficheros</strong></div>
			<div class="card-body">
			
				<div class="col-sm-4 ml-auto mr-auto border p-3">
					<form method="post" enctype="multipart/form-data" action="upload.php">
						<div class="form-group">
							<label><strong>Subir ficheros</strong></label>
							<div class="custom-file">
								<input required type="file" name="files[]" multiple class="custom-file-input" id="customFile">
								<label class="custom-file-label" for="customFile">Seleccionar fichero</label>
							</div>
							<div>
								<label  for="descripcion">Descripción</label>
								<textarea required name="descripcion" id="descripcion" rows="5" cols="40"></textarea>
							</div>							
						</div>

						<div class="form-group">
							<button type="submit" name="upload" value="upload" id="upload" class="btn btn-block btn-dark"><i class="fa fa-fw fa-upload"></i> Subir fichero</button>
						</div>
					</form>
				</div>
				<hr>
				<div class="card-header" ></i><h2> <i class="fas fa-users"></i> Mis archivos</h2> </div>
				<div class="table table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr class="bg-primary text-white">
									<th width="25">Id.</th>
									<th>Fecha</th>
									<th>Nombre de fichero</th>
									<th>Propietario</th>
									<th>Acciones</th>
									<th>Descripción</th>
									<th>Asignado</th>
								</tr>
							</thead>
							<tbody>
								<?php
								//$db  =   new mysqli('localhost','root','','smistms');
								
								$sql="SELECT * FROM fichero ";
								$sql.= "  order by  fecha DESC LIMIT 100";

								//echo "<br>".$sql;
								$fileQry	=	$conexion->query($sql);
								
								if(!$fileQry)
								{echo "<tr><td colspan=6>No hay ficheros</td></tr>";}
								else
								{
										if($fileQry->num_rows>0){
											$s		=	'';
											while($row	=	$fileQry->fetch_assoc()){
												$s++;
										?>
										<tr>
											<td><?php echo $row['id_fichero'];?></td>
											<td><?php echo $row['fecha'];?></td>
											<td>
												<div class="custom-control custom-checkbox mb-3">
													<?php echo "<a target='_blank' href='descarga.php?id_fichero=".$row['id_fichero']."&nombre=".$row['nombre']."'>".$row['nombre']."</a>";?>
												</div>
											</td>
											<td> 
											</td>
											<td>
												
												<br><a href="delete_fichero.php?id_fichero=<?php echo $row['id_fichero'];?>" class="text-danger" onClick="return confirm('seguro que quiere eliminar este fichero?');"><i class="fa fa-fw fa-trash"></i> Eliminar</a>
											</td>
											<td>
												<?php echo "<font size=2>".$row['descripcion']."</font>";?>
											</td>
											<td>
												
											</td>

										</tr>
											<?php 
											}
										} 
								}?>
							</tbody>
						</table>
					
				</div>
			</div>

		</div>
	</div>
	
	<?php /*?><div class="container my-4">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- demo left sidebar -->
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="ca-pub-6724419004010752"
			 data-ad-slot="7706376079"
			 data-ad-format="auto"
			 data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div><?php */?>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function(){
			$('input[type="file"]').on('change', function () {
				let filenames = [];
				let files = document.getElementById('customFile').files;
				if(files.length>1){
					filenames.push('Total Files ('+files.length+')');
				}else{
					for (let i in files) {
						if (files.hasOwnProperty(i)) {
							filenames.push(files[i].name);
						}
					}
				}
				$(this).next('.custom-file-label').html(filenames.join(','));
			});
		});
	</script>
</body>
</html>