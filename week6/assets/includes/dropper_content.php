<?php
/**
 * Created by PhpStorm.
 * User: Nomad_Mystic
 * Date: 5/3/2016
 * Time: 4:56 PM
 */

require_once('LoadableContent.php');
require_once('User.php');
require_once('ImageSet.php');

$file_key = ImageSet::FILE_KEY;


$js = <<<JS
function dropper() {
    // local variables
    var dragCount = 0;
    var files =[];
    var uploadCount = 0;
    
    
    // create events
    $(document)
    .on('dragover', function(evnt) {
        evnt.stopPropagation();
        evnt.preventDefault();
    })
    .on('dragenter', function(evnt) {
        evnt.stopPropagation();
        evnt.preventDefault();
        dragCount++;
        if (dragCount === 1) {
            showDialog();
        }
    })
    .on('dragleave', function(evnt) {
        evnt.stopPropagation();
        evnt.preventDefault();
        dragCount--;
        if (dragCount === 0) {
            hideDialog();
        }
    })
    .on('drop', function(evnt) {
        evnt.stopPropagation();
        evnt.preventDefault();
        // this is a string but this is shorthand for turn each item into a property of an array
        var droppedFiles = [].slice.call(evnt.originalEvent.dataTransfer.files);
        files = files.concat(droppedFiles);
        updateFileList();
    });
    
    // hide the dialog for dropper event 'drop'
    function hideDialog() {
        $('#dropper_dialog').dialog('close');
    }
    
    // activate dropper dialog modal 
    function showDialog() {
        files = [];
        uploadCount = 0;
        updateFileList();
        
        $('#dropper_dialog').dialog({
            width: 600,
            model: true,
            buttons: {
                'Ok': function() 
                {
                    files.forEach(uploadFile);
                },
                'Cancel': function() 
                {
                    hideDialog();
                    dragCount = 0;
                }
            }
        }); // end jQuery dialog
    } // end showDropper() 
    
    function updateFileList() {
        var html = ''; 
        
        if (uploadCount === 0) {
            $('#update_count_message').text('');
        } else if (uploadCount === 1) {
            $('#update_count_message').text('Uploaded One File!');
        } else {
            $('#update_count_message').text('Uploaded ' + uploadCount + ' Files');
        }
        
        if (files.length === 0) {
            $('#uploading_files').hide();
            return;
        } else if (files.length === 1) {
            $('#upload_message').text('Click ok to upload the following file:');
            $('#uploading_files').show();
        } else {
            $('#upload_message').text('Click ok to upload the following files:');
        }
        $('#uploading_files').show();
        // loop through each of files 
        files.forEach(function(file) {
           html += '<li>' + file.name + '</li>'; 
        });
        $('#uploading_files_list').html(html);
    } // end updateFileList()
    
    function uploadFile(file) {
        // create new form data object 
        var formDataObject = new FormData();
        // use append for dataObject 
        formDataObject.append('{$file_key}', file);
        $.ajax('assets/actions/upload_file.php', {
            type: 'POST',
            processData: false,
            contentType: false,
            // the data the AJAX call sends in the request
            data: formDataObject,
            success: function(data) {
                files.splice(files.indexOf(file), 1);
                uploadCount++;
                console.log(data);
                updateFileList();
            }
        });
    }
}
JS;

$html = <<<HTML
<div title="Please upload images" id="dropper_dialog">
    <div>
        <p>Drop your content here.</p>
    </div>
    <div id="uploading_files">
        <p>Click ok to upload the following</p>
        <ul id="uploading_files_list"></ul>
    </div>
    <p id="update_count_message"></p>
</div>
HTML;

$css = <<<CSS
fieldset {
     padding: 20px;
}
fieldset input {
     display: block;
     margin-bottom: 12px;
     width: 30em;
}
fieldset label {
     display: block;
}
#dropper_dialog { 
    display: none;
}
.ui-dialog-titlebar-close {
     display: none;
}
.linked {
    color: green;
}
.linked:hover {
    cursor: pointer;
}
CSS;

$object = new LoadableContent($js, $html, $css);
$object->load();
