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
			
			
			
			
			var myFiles = [];


			
			var makeFileListView = function(draggedFiles){
				
				// check dragged files for duplicates
				$.each(draggedFiles, function(i,item){
					if(!jQuery.inArray()){ }
				});
			}
			
			var fileRow = function(fileObj){
				var html = '<div><span>'+fileObj.name+'</span><span>delete</span></div>';
				var key = key;
				$($(html).find('span')[1]).bind('click', function(){
					fileObj.remove = true;
				});
				return html;
			}
			
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
				uploadTarget = $('#upload-target');
				bindDragEvents();
			});
			
			
			
		</script>
		<style>
			#upload-target > div { }
			#upload-target > div > span:first-child { font-weight: bold; }
			#upload-target > div > span:last-child { color: red; cursor: pointer; padding-left: 10px; }
			#upload-target > div > span:last-child:hover { text-decoration: underline; }
		</style>
	</head>

	<body>
		<div>
			<header>
				<h1>Drag files to browser</h1>
			</header>
			<div id="upload-target" style="border: 3px solid #ccc; padding: 15px; margin-bottom: 10px; min-height: 250px;">
				<div><span>test.txt</span><span>delete</span></div>
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
			<p>To drag files from your computer into browser and list them. Delete from list, or prevent duplicate names.</p>			
			<p>Using JavaScript and html5 to get files from dropped area and combine them into a list for later use.s</p>
			<p>Doing it this way keeps the server side code the same as you would normally catch POST data.</p>
			<footer style="color: #ccc; margin-top: 125px; border-top: 1px solid #ccc;">
				<p>eligeske</p>
			</footer>
		</div>
	</body>
</html>
