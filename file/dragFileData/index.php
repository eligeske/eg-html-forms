<?php  
print_r($_FILES);
print_r($_POST);
if(isset($_POST["sent"])){
	if(isset($_FILES) && isset($_FILES["file"])){ 
		sleep(3);
		echo "uploaded: ".$_FILES["file"]["name"];
		
	}	
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
			body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; line-height: 150%; 10px; }
			#file-target { border: 5px solid #ccc; padding: 2px 10px; margin-bottom: 1px; min-height: 150px; }
			#output, #serverOutput { margin: 25px;  }
			#output > div, #serverOutput > div { border-bottom: 1px solid #ccc; line-height: 25px;  }
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
			var outputCont;
			var files = [];
			var fileRow = function(fileObj){
				var key = files.push(fileObj);
				var lastModified = fileObj.lastModified;
				var name = fileObj.name;
				var size = fileObj.size;
				var type = fileObj.type;
				var h = name+" | "+size+" | "+type;
				var ele = $("<div>", { html: h, "data-file": "file-"+key });
				outputCont.append(ele);
			}
			var stopprop = function(e){ 
				e.stopPropagation(); 
				e.preventDefault(); 
			}		
			var targetHover = function(hoverFlag){ 
				(hoverFlag)?uploadTarget.addClass('drag-over'):uploadTarget.removeClass('drag-over');	
			}
			var bindDragEvents = function(){
				
				uploadTarget.bind('dragenter',function(e){
					console.log("dragenter");
					stopprop(e);
					targetHover(true);
				});
				uploadTarget.bind('dragover',function(e){
					console.log("dragover");
					stopprop(e);
					targetHover(true);
				});
				uploadTarget.bind('dragexit',function(e){
					console.log("dragexit");
					stopprop(e);
					targetHover(false);
				});
				uploadTarget.bind('dragleave',function(e){
					console.log("dragleave");
					stopprop(e);
					targetHover(false);
				});
				uploadTarget.bind('drop',function(e){
					console.log("drop");
					stopprop(e);
					targetHover(false);
					
					console.log(e.originalEvent.dataTransfer);
					var files = e.originalEvent.dataTransfer.files;
					$.each(files,function(i,item){
						fileRow(item);	
					});
					
				});
			}
			var removeFile = function(id){
				files.splice(id.split("file-")[1],1);				
			}
			var sendAjax = function(file, key){
				var formData = new FormData(); 
				formData.append("file", file);
				formData.append("sent", 1);
				var xhr = new XMLHttpRequest();
				xhr.open("POST","index.php");  // uploadUrl is url to server
				xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
				xhr.upload.addEventListener("progress", function(pe){
					console.log(pe);
				}, false);
				// xhr.onprogress = function(pe){
					// console.log(pe);
				// }
				
				xhr.onreadystatechange = function(){
					if(xhr.readyState == 4){
						$("#serverOutput").append($("<div>",{ html: xhr.responseText }));
						files.splice(key,1);						
					}
				}
				
				xhr.send(formData);
			}			
			var upload = function(){
				$.each(files, function(i,item){
					sendAjax(item,i);	
				});
				files = [];
			}
			$(function(){
				uploadTarget = $('#file-target');
				outputCont  = $('#output');
				bindDragEvents();
				$("#button").click(upload);
			});
			
		</script>
	</head>

	<body>
		<div id="file-target">

		</div>
		<button id="button">Upload</button>
		<table>
			<tr>
				<td valign="top">
					<div id="output">
			
					</div>					
				</td>
				<td valign="top">
					<div id="serverOutput">
			
					</div>	
				</td>
			</tr>
		</table>
		
	</body>
</html>
