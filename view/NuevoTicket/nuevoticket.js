function init(){
   
    $("#ticket_form").on("submit",function(e){
        guardaryeditar(e);	
    });
    
}

$(document).ready(function() {
    $('#tick_descrip').summernote({
        height: 400,
        lang: "es-ES",
        callbacks: {
            onImageUpload: function(image) {
                console.log("Image detect...");
                myimagetreat(image[0]);
            },
            onPaste: function (e) {
                console.log("Text detectus...");
            }
        },
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
    });

    $.post("../../controller/categoria.php?op=combo",function(data, status){
        $('#cat_id').html(data);
    });

});

function guardaryeditar(e){
    e.preventDefault();
    var formData = new FormData($("#ticket_form")[0]);
    if ($('#tick_descrip').summernote('isEmpty') || $('#tick_titulo').val()==''){
        swal("Advertencia!", "Campos Vacios", "warning");
    }
    // else{
    //     var totalfiles=$('#fileElem').val().length;
    //     console.log(totalfiles);
    //     for(var i=0; i< totalfiles; i++){
    //         formData.append("files[]", $('#fileElem')[0].files[i]);
    //     }
        datum = formData;
        console.log($('#tick_titulo').val());
        CreateTicket(formData);

        
        // $.ajax({
        //     url: '../../controller/ticket.php?op=insert',
        //     type: 'POST',
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function(data){  
        //         console.log(data);
        //         data = JSON.parse(data);
        //         console.log(data[0].tick_id);
                
        //         $.post("../../controller/email.php?op=ticket_abierto", {tick_id : data[0].tick_id}, function (data) {});
                
        //         $('#tick_titulo').val('');
        //         $('#tick_descrip').summernote('reset');
        //         swal("Correcto!", "Registrado Correctamente", "success");


        //     }  
        // });  
    }

    function CreateTicket(formData){
    $.ajax({
            url: '../../controller/ticket.php?op=insert',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(data){  
                console.log(data);
                data = JSON.parse(data);
                console.log(data[0].tick_id+' '+$('#tick_titulo').val()+' '+$($('#tick_descrip').summernote('code')).text());
                $.post('../../Mail/mailo.php?op=open_ticket', {tick_id : data[0].tick_id, tick_title : $('#tick_titulo').val(), tick_descrip : $($('#tick_descrip').summernote('code')).text()});
                // $.post('../../controller/email.php', {tick_id : data[0].tick_id});
                // SendMailo(data[0].tick_id);
                $('#tick_titulo').val('');
                $('#tick_descrip').summernote('reset');
                swal("Correcto!", "Registrado Correctamente", "success");

            }
    });
}
//---------------------------------------------------------------------------------------ENVIA CORREO AL CREAR UN TICKET--------------------------------------------------------------------///
function SendMailo(formData){
    $.ajax({
        // url: '../../controller/ticket.php?op=insert',
        url: '../../Mail/mailo.php',
        type: 'POST',
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function (data) {
            
            alert(data);
            console.log(data);
            // data = JSON.parse(data);
            // console.log(data[0].tick_id);
            
            // $.post('../../Mail/mail.php?op=open_ticket', {tick_id : data[0].tick_id});
            
            // $('#tick_titulo').val('');
            // $('#tick_descrip').summernote('reset');
            // swal("Correcto!", "Registrado Correctamente", "success");
        }
   });
}   

init();