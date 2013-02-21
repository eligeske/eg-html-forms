<?php

if(isset($_GET['upload'])){
	
	echo json_encode($_FILES);	
	exit();
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Form Inputs</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
		<style>
			body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 150%; }
			
		</style>
		<script>		
			<?php $url = $_SERVER['PHP_SELF']."?upload=true"; ?>
			
			var uploadURL = "<?php echo $url; ?>";
			
			$(function(){
				$($('body input')[0]).change(function(){
					sendFile($(this)[0].files[0]);
				});
			});
			
			var sendFile = function(file){
				var formData = new FormData();
				formData.append("file", file);
				var xhr = new XMLHttpRequest();
				
				xhr.open("POST",uploadURL);
				
	            xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
				
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4){
						// completed
						$('#output').html(xhr.responseText);
					}
				}
				
				xhr.send(formData);
				
			}
			
			
			
		</script>
	</head>

	<body>
		<div>
			<header>
				<h1>Ajax File Upload</h1>
			</header>			
			<div>
				<input type="file" />				
			</div>
			<fieldset style="margin-top:10px">
				<legend>Server Response</legend>
				<div id="output" style="padding: 10px;">
					
				</div>	
			</fieldset>
			
			<footer style="color: #ccc; margin-top: 125px; border-top: 1px solid #ccc;">
				<p>eligeske</p>
			</footer>
		</div>
	</body>
</html>

