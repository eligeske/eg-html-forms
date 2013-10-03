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
			form input { display: block; }
		</style>
		<script>		
	
		function addInput(){
			var inp = $('<input>',{ type: 'file', name: 'file[]'});
			$($('#myUploader span')[0]).append(inp);
			inp.change(function(){
				$('#uploadForm').append(inp);
				$(this).unbind('change');
				addInput();
			});
		}	
		$(function(){
			addInput();	
		});
			
		</script>
		<style>
			
		</style>
	</head>

	<body>
		<div>
			<header>
				<h1>iframe upload</h1>
			</header>			
			<div>
				<span id="myUploader">
					<span></span>
					<span></span>
				</span>
				
			</div>
			<fieldset>
				<legend>Form</legend>	
				<?php 
								
				$url = $_SERVER['PHP_SELF']."?upload=true";
				
				?>		
				<form id="uploadForm" action="<?php echo $url; ?>" method="POST" accept-charset="UTF-8" target="uploadFrame" enctype="multipart/form-data" encoding="multipart/form-data">
					
					<input type="submit" value="submit">
				</form>
			</fieldset>
			<fieldset>
				<legend>iFrame</legend>			
				<iframe name="uploadFrame" src="about:blank" style="height: 200px; width: 100%; border: none;" >
					
				</iframe>
			</fieldset>
			<h3>Requirements</h3>
			<ul>
				<li>jQuery, newest</li>
			</ul>
			<h3>Demo Environment</h3>
			<ul>
				<li>PHP Server (only to show posts)</li>
			</ul>		
			<h3>Quick Explanation</h3>
			<p>Doing file uploads without refreshing page, without ajax, using an iFrame</p>			
			<p>This is the most basic example of usage to help better understand about the readonly DOM File object that is bound to the input type, file.In order to upload a file you must keep the input and it's data together</p>
			<p><b>How this example works:</b> <br/>On page load, an input [type="file"] is created, when a file is added to it, the event is triggered which appends it to the form. 
				Then a new input [type="file"] is put in it's place that does the same thing.
				When you press submit the form post's to the iframe which returns the data from the PHP output into the iframe. You can then read the response from the iframe and do something with it.
			 </p>
			<p>In order to upload a file you must keep the input and it's data together.</p>
			<h3>Some Ideas</h3>
			<p>You can easily add delete buttons next to each of the file inputs, or get the file name, hide the input and create some prettiness.</p>
			<p>For individual file upload, success/failure, create a new form and iframe for each file.</p>
			<footer style="color: #ccc; margin-top: 125px; border-top: 1px solid #ccc;">
				<p>eligeske</p>
			</footer>
		</div>
	</body>
</html>
