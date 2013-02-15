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
			.file-container { padding: 2px 10px; margin-bottom: 1px; }
				.file-container .file-input { }
				.file-container .file-add { cursor: pointer; color: green; width: 200px; background: green; color: white;  padding: 3px 0; text-align: center; }
				.file-container .file-add:hover { background: #7ABA7B; }
				.file-container .file-name { font-weight: bold; font-size: 15px; }
				.file-container .file-remove { display: none; cursor: pointer; margin-right: 10px; color: red; border: 1px solid red; padding: 2px; text-align: center; }
				.file-container .file-remove:hover{ background: red; color: white; } 
			
			.drag-over { background: green; }
			
		</style>
		<script>		
			
			var uploadTarget;
			var stopprop = function(event){ event.stopPropagation(); event.preventDefault(); }
			var targetHover = function(addFlag){ 
				(addFlag)?uploadTarget.addClass('drag-over'):uploadTarget.removeClass('drag-over');	
			}
			var bindDragEvents = function(){
				
				uploadTarget.bind('dragenter',function(event){
					stopprop(event);
					targetHover(true);
				});
				uploadTarget.bind('dragover',function(){
					stopprop(event);
					targetHover(true);
				});
				uploadTarget.bind('dragexit',function(){
					stopprop(event);
					targetHover(false);
				});
				// uploadTarget.bind('drop',function(event){
					// stopprop(event);
					// targetHover(false);
// 					
					// console.log(event.originalEvent.dataTransfer);
// 					
				// });
				uploadTarget[0].addEventListener('drop',function(evt){
					stopprop(evt);
					targetHover(false);
					console.log(evt);
					var files = evt.dataTransfer.files;
					var count = files.length;
					console.log(count);
					console.log(files);
				});
			}
			
			$(function(){
				UploadList('upload-container', "files");
				uploadTarget = $('#upload-target');
				bindDragEvents();
			});
			
			var UploadList = function(containerId, name){
				var self = this;
				var isIE = (navigator.appName == 'Microsoft Internet Explorer');
				var uc = $('#'+containerId);
				var inputName = name + "[]";
				
				var addNewUpload = function(){
					uc.append(uploadInput());
				}
				var uploadInput = function(){
					var cont = $('<div>',  { 'class':'file-container' });
					var inp = $('<input>', { type: "file", 'class': 'file-input', name: inputName });
					var add = $('<div>',   { html: "add", 'class': 'file-add' });
					var nm = $('<span>',   { 'class': 'file-name' });
					var rmv = $('<span>',  { html: "remove", 'class': 'file-remove' });
					isIE ? add.hide():inp.hide();
					$(add).click(function(){
						inp.click();
					});
					$(rmv).click(function(){
						cont.remove();
					});
					inp.change(function(e){
						var name = $(this).val().split('\\');
						nm.html(name[name.length - 1]);
						add.hide(); inp.hide(); rmv.show();
						$(this).blur(); addNewUpload();
					});
					cont.append(inp).append(add).append(rmv).append(nm);
					return cont;
				}
				addNewUpload();
			}
			
			
		</script>
	</head>

	<body>
		<div>
			<header>
				<h1>form > input[type='file']  (adding removing multiple)</h1>
			</header>
			<?php  if(isset($_FILES) && isset($_FILES['files'])){ ?>				
				<div style="border: 3px solid #ccc; padding: 15px; margin-bottom: 10px;">
					<?php 
						$names = $_FILES['files']['name'];
						foreach($names as $key => $name){
							echo "<div>$name</div>";
						}
					?>
				</div>		
			<?php } ?>
			<div>
				<form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<div id="upload-target" style="border: 3px solid #ccc; padding: 15px; margin-bottom: 10px; min-height: 250px;">
						
					</div>
					<div id="upload-container" style="border: 3px solid #ccc; padding: 15px; margin-bottom: 10px;">
						
					</div>
					<div>
						<input type="submit" value="submit"  />
					</div>
				</form>
				
			</div>
			
			<h3>Requirements</h3>
			<ul>
				<li>jQuery, newest</li>
			</ul>
			<h3>Demo Environment</h3>
			<ul>
				<li>PHP Server (only to show posts)</li>
			</ul>		
			<h3>Quick Explanation</h3>
			<p>To keep a form submission simple while allowing additional file uploads.</p>			
			<p>There are always ways to determine if html5 or flash is available and allow multiple uploads. But this does not allow them to be included in the same form POST.</p>
			<p>Doing it this way keeps the server side code the same as you would normally catch POST data.</p>
			<footer style="color: #ccc; margin-top: 125px; border-top: 1px solid #ccc;">
				<p>eligeske</p>
			</footer>
		</div>
	</body>
</html>
