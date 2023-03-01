function init(){
   
}

$(document).ready(function(){
    var usu_id = $('#user_idx').val();

    if ( $('#rol_idx').val() == 1){
        $.post("../../controller/usuario.php?op=total", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        }); 
    
        $.post("../../controller/usuario.php?op=totalabierto", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        $.post("../../controller/usuario.php?op=totalcerrado", {usu_id:usu_id}, function (data) {
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });

        // $.post("../../controller/usuario.php?op=grafico", {usu_id:usu_id},function (data) {
        //     data = JSON.parse(data);
    
        //     new Morris.Bar({
        //         element: 'divgrafico',
        //         data: data,
        //         xkey: 'nom',
        //         ykeys: ['total'],
        //         labels: ['Value'],
        //         barColors: ["#1AB244"], 
        //     });
        // }); 

    }else{
        $.post("../../controller/ticket.php?op=total",function (data) {
            data = JSON.parse(data);
            $('#lbltotal').html(data.TOTAL);
        }); 
    
        $.post("../../controller/ticket.php?op=totalabierto",function (data) {
            data = JSON.parse(data);
            $('#lbltotalabierto').html(data.TOTAL);
        });
    
        $.post("../../controller/ticket.php?op=totalcerrado", function (data) {
            data = JSON.parse(data);
            $('#lbltotalcerrado').html(data.TOTAL);
        });  

        $.post("../../controller/ticket.php?op=grafico",function (data) {
            data = JSON.parse(data);
    
            new Morris.Bar({
                element: 'divgrafico',
                data: data,
                xkey: 'nom',
                ykeys: ['total'],
                labels: ['Value'],
                resize: true
            });
        }); 


        $.post("../../controller/ticket.php?op=graficoasig",function (data) {
            // console.log(data);
            // console.log(data.lenght);
            
            data = JSON.parse(data);
            
            // console.log(data);
            // console.log(data.lenght);
            // console.log(...data.Nombre);
            
            // new  Morris.Bar({
            //     element: 'divigrafico',
            //     data: data,
            //    xkey: 'Nombre',
            //     ykeys: ['total'],
            //     labels: ['Value'],
            //     resize: true
            // });
            datum = new Array();
            data.forEach(dati => {
                datum.push({label: dati.Nombre, value: dati.total});
              
            });

            // console.log(datum);

            new  Morris.Donut({
                element: 'divigrafico',
                data: datum,
                resize: true

            });
        }); 



        $.post("../../controller/ticket.php?op=graficoabiert",function (data) {
            // console.log(data);
            // console.log(data.lenght);
            
            data = JSON.parse(data);
            
            // console.log(data);
            // console.log(data.lenght);
            
            openTicket = [];
            $.post("../../controller/ticket.php?op=totalabierto",function (datas) {
                datas = JSON.parse(datas);
                openTicket.push(datas.TOTAL);
                ticketAsig=0;
                datum = new Array();
                data.forEach(datu => {
                    datum.push({label: datu.Nombre, value: datu.total});
                    console.log(Number(ticketAsig) + Number(datu.total));
                    ticketAsig = Number(ticketAsig) + Number(datu.total);
                });
                
                openTicket.push(openTicket[0] - ticketAsig);
                datum.push({label: 'No Asignados', value: openTicket[1]});

                // console.log(openTicket[0]);
                // console.log(openTicket[1])
                ;
                // console.log(datum);

                new  Morris.Donut({
                    element: 'divgraficos',
                    data: datum,
                    resize: true
                });
                // console.log(data.TOTAL);
                // console.log(openTicket);
                // $('#lbltotalabierto').html(data.TOTAL);
            });

            
        }); 



    }

 
});

init();