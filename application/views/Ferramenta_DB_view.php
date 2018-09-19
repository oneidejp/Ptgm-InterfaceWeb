<div class="container-fluid" disabled="true">
    <div class="row-fluid">
        <div class="col-xs-10 col-xs-offset-1" id="centro">
            <div id="aba1">
                <div class="row-fluid">

			<p style="font-size: 50px; text-align: center; font-weight: bolder;"> In Maintenance </p>

                    <div class="col-xs-10 col-xs-offset-1 hidden" id="formcentro">
                        <br>
                        <a id="aBackup" class="aDB" href="">Backup</a>
                        <scan class="hidden" id="loader"><?php echo $this->lang->line('loading_db'); ?>
                                <img src="../includes/imagens/ajax-loader-backup.gif"></scan>
                        <br>
                        <br>
                        <br>
                        
                        
                        
                        <a id="aRestore" class="aDB" href="">Restore</a>
                        <input type="file" id="myFile" name="myFile">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script> //pega a baseURL
    function getURL() {
        var baseUrl = location.origin + "/" + window.location.pathname.split('/')[1] + "/";
        return baseUrl;
    }
</script>

<script>
    
    $("#aBackup").click(function (e){
        e.preventDefault();
        $("#loader").removeClass("hidden");
        var baseUrl = getURL();
        
        $.ajax({
            url: baseUrl + "index.php/Ferramenta_DB/backupDB",
            success: function() {
                window.location = baseUrl + "backup.sql";
                $("#loader").addClass("hidden");
            },
            error: function() {
                alert("Error");
                $("#loader").addClass("hidden");
            }
        });
    });
    
    $("#aRestore").click(function(e){
        e.preventDefault();
        var file = document.getElementById('myFile').files[0]; //Files[0] = 1st file
        var reader = new FileReader();
        reader.readAsText(file, 'UTF-8');
        reader.onload = shipOff;
        
//reader.onloadstart = ...
//reader.onprogress = ... <-- Allows you to update a progress bar.
//reader.onabort = ...
//reader.onerror = ...
//reader.onloadend = ...


        function shipOff(event) {
            var result = event.target.result;
            var fileName = document.getElementById('myFile').files[0].name; //Should be 'picture.jpg'
            if(fileName === "backup.sql"){
                var baseUrl = getURL();
                $.ajax({
                    url: baseUrl + "index.php/Ferramenta_DB/restoreDB",
//                    data: {
//                        Backup: result
//                    },
                    success: function() {
                        alert("restore");
                    },
                    error: function() {
                        alert("Error");
                    }
                });
            } else {
                alert("File invalid!");
            }
        }
    });
    
    
    
//==============================================================================    
//    $("#aRestore").click(function (e){
//        e.preventDefault();
//        var backup = $("#myFile");
//        if(backup.val() !== ""){
//            var baseUrl = getURL();
//            $.ajax({
//                url: baseUrl + "index.php/Ferramenta_DB/restoreDB",
//                data: {
//                    Backup: backup
//                },
//                success: function() {
//                    alert("restore");
//                },
//                error: function() {
//                    alert("Error");
//                }
//            });
//        }
//    });
//==============================================================================
//    
//  
//============================================================================== 
//$(function(){
//    var myFile = document.getElementById('myFile');
//    var formData = new FormData(myFile); 
//});
//==============================================================================
//==============================================================================
//    // Variable to store your files
//    var files;
//
//    // Add events
//    $('#myFile').on('change', prepareUpload);
//
//    // Grab the files and set them to our variable
//    function prepareUpload(event)
//    {
//      files = event.target.files;
//    }
//    
//    $('#aRestore').on('click', uploadFiles);
//
//    // Catch the form submit and upload the files
//    function uploadFiles(event)
//    {
//        event.stopPropagation(); // Stop stuff happening
//        event.preventDefault(); // Totally stop stuff happening
//
//        // START A LOADING SPINNER HERE
//
//        // Create a formdata object and add the files
//        var data = new FormData();
//        $.each(files, function(key, value)
//        {
//            data.append(key, value);
//        });
//
//        $.ajax({
//            url: 'submit.php?files',
//            type: 'POST',
//            data: data,
//            cache: false,
//            dataType: 'json',
//            processData: false, // Don't process the files
//            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
//            success: function(data)
//            {
//                if(typeof data.error === 'undefined')
//                {
//                    // Success so call function to process the form
//                    submitForm(event, data);
//                }
//                else
//                {
//                    // Handle errors here
//                    console.log('ERRORS: ' + data.error);
//                }
//            },
//            error: function(textStatus)
//            {
//                // Handle errors here
//                console.log('ERRORS: ' + textStatus);
//                // STOP LOADING SPINNER
//            }
//        });
//    }
//==============================================================================
//==============================================================================    
//    var form;
//    $("#myFile").change(function () {
//        form = new FormData();
//        form.append('myFile'); // para apenas 1 arquivo
//    });
//
//    $("#aRestore").click(function () {
//        var backup = $("#myFile");
//        if(backup.val() !== ""){
//            var baseUrl = getURL();
//            $.ajax({
//                url: baseUrl + "index.php/Ferramenta_DB/restoreDB",, // Url do lado server que vai receber o arquivo
//                data: form,
//                processData: false,
//                contentType: false,
//                type: 'POST',
//                success: function (data) {
//                    // utilizar o retorno
//                }
//            });
//        }
//    });
//==============================================================================    

</script>