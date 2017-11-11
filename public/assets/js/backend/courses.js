jQuery(document).ready(function(){

	if(typeof CKEDITOR !== 'undefined')
	{
	    CKEDITOR.replace('course_short_description');
	    CKEDITOR.replace('course_description');
	    CKEDITOR.replace('course_requirements');
	    CKEDITOR.replace('what_will_learn');
	}

	$(document).on('click', '.remove_module', function(){
		$(this).parent('div.courses_module').remove();
	});

	$('button#addNewModule').click(function(){
		var sizeModule = $('div#module_container > div').length;
		var str = '<div id="module-'+ sizeModule +'" class="courses_module">'+
						'<a class="remove_module"><i class="fa fa-close"></i></a>'+
			            '<div class="form-group">'+
			                '<label class="form-label">Module Name</label>'+
			                '<div class="controls">'+
			                    '<input type="text" class="form-control" name="module['+ sizeModule +'][module_name]">'+
			                '</div>'+
			            '</div>'+
			            '<div class="form-group">'+
			                '<label class="form-label">Module Description</label>'+
			                '<div class="controls">'+
			                    '<textarea id="" placeholder="Enter Description" name="module['+ sizeModule +'][module_description]" class="form-control" rows="10"></textarea>'+
			                '</div>'+
			            '</div>'+
			            '<div class="form-group">'+
			                '<label class="form-label">Upload Video</label>'+
			                '<div class="controls">'+
			                    '<input name="module['+ sizeModule +'][module_video]" id="module_file_'+sizeModule+'" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" type="file">'+
			                    '<label for="module_file_'+ sizeModule +'" ><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>Choose a file…</span></label>'+
			                '</div> '+
			            '</div>'+
			        '</div>';
		$('div#module_container').prepend(str);
	});
});

function addModuleStr()
{

}