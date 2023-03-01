<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();
    require_once("../models/Usuario.php");
    $usuario = new Usuario();
    require_once("../models/Documento.php");
    $documento = new Documento();

    switch($_GET["op"]){
 // --------------------------------------------------------------INSERTAR TICKET-----------------------------------------------------------------------------------       
        case "insert":
            $datos=$ticket->insert_ticket($_POST["usu_id"],$_POST["cat_id"],$_POST["tick_titulo"],$_POST["tick_descrip"]);
            // if (is_array($datos)==true and count($datos)>0){
               
            //     foreach ($datos as $row){
            //         $output["tick_id"] = $row["tick_id"];
                   
            //         if ($_FILES['files']['name']==0){
                     
            //         }else{
            //             $countfiles = count($_FILES['files']['name']);
            //             $ruta = "../public/document/".$output["tick_id"]."/";
            //             $files_arr = array();

            //             if (!file_exists($ruta)) {
            //                 mkdir($ruta, 0777, true);
            //             }

            //             for ($index = 0; $index < $countfiles; $index++) {
            //                 $doc1 = $_FILES['files']['tmp_name'][$index];
            //                 $destino = $ruta.$_FILES['files']['name'][$index];

            //                 $documento->insert_documento( $output["tick_id"],$_FILES['files']['name'][$index]);

            //                 move_uploaded_file($doc1,$destino);
            //             }
            //         }
            //     }
            // }
            echo json_encode($datos);
        break;
// --------------------------------------------------------------INSERTAR TICKET-------------------------------------------------------------------------------------        
// ---------------------------------------------------------------  UPDATE  ----------------------------------------------------------------------------
        case "update":
            $ticket->update_ticket($_POST["tick_id"]);
            $ticket->insert_ticketdetalle_cerrar($_POST["tick_id"],$_POST["usu_id"]);
        break;
// ---------------------------------------------------------------  UPDATE  ----------------------------------------------------------------------------

// ---------------------------------------------------------------  Cerrar Ticket  ----------------------------------------------------------------------------
        case "cerrar_ticket":
           $ticket->update_ticket_asignacion_cierre($_POST["tick_id"],$_POST["usu_id"]);    
        break;
// ---------------------------------------------------------------  Cerrar Ticket  ----------------------------------------------------------------------------

// ---------------------------------------------------------------  Asignar Ticket  ----------------------------------------------------------------------------
        case "asignar":
            $ticket->update_ticket_asignacion($_POST["tick_id"],$_POST["usu_asig"]);
        break;
// ---------------------------------------------------------------  Asignar Ticket  ----------------------------------------------------------------------------

// ---------------------------------------------------------------  Listar Ticket Usuario  ----------------------------------------------------------------------------
        case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];
                $sub_array[] = $row["usu_nom"];
              
                        //ESTADO-----------------------------------------------------------------------------------------
                                    
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                }
                //FECHA DE CREACION Y ASIGNACION---------------------------------------------------------------
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                
                if ($row["fech_asig"]==NUll){
                    $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }

               

                if ($row["usu_asig"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">Sin Asignar</span>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1 ){
                        $sub_array[] = '<span class="label label-pill label-success ">'.$row1["usu_nom"].' </span>';  
                    }
                }
 
                
                //FECHA DE CIERRE-------------------------------------------------------------------------------------------------
                if ($row["fech_cierre"]==NUll){
                    $sub_array[] = '<span class="label label-pill label-default">Sin Terminar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                }


                if ($row["usu_cierre"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">Sin Terminar</span>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_cierre"]);
                    foreach($datos1 as $row1 ){
                        $sub_array[] = '<span class="label label-pill label-success ">'.$row1["usu_nom"].' </span>';  
                    }
                }
                 
                $date1 = date_create($row["fech_crea"]);
                $date2 = date_create($row["fech_asig"]);
                $date3 = date_create($row["fech_cierre"]);
                //FECHA DE ASIGNACION ------------------------------------------------------------------------------------------------
                if ($row["fech_asig"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">No Asignado </span>';
                }else{
                    $sub_array[] = date_diff($date2, $date1)->format("%h h: %i m: %s s");
                }
               
                if ($row["fech_cierre"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">No ha sido resuelto </span>';
                    $sub_array[] = '<span class="label label-pill label-warning">No ha sido resuelto </span>';
                }else{

                    $sub_array[] = date_diff($date3, $date1)->format("%h h: %i m: %s s");
                    $sub_array[] = date_diff($date3, $date2)->format("%h h: %i m: %s s");
                }
              
               
               
                
                // $sub_array[] = $row["timeEA"];
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
                
            }
            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
// ---------------------------------------------------------------  Listar Ticket Usuario  ----------------------------------------------------------------------------

// ---------------------------------------------------------------  Listar Ticket Soporte  ----------------------------------------------------------------------------
        case "listar":
            $datos=$ticket->listar_ticket();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["tick_id"];
                $sub_array[] = $row["cat_nom"];
                $sub_array[] = $row["tick_titulo"];
                $sub_array[] = $row["usu_nom"];
                //ESTADO-----------------------------------------------------------------------------------------
                if ($row["tick_estado"]=="Abierto"){
                    $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
                }else{
                    $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
                }
                //FECHA DE CREACION Y ASIGNACION---------------------------------------------------------------
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));

                if ($row["fech_asig"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';
                }else{
                    $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_asig"]));
                }
              

                if ($row["usu_asig"]==NULL){
                    $sub_array[] = '<a onClick="asignar('.$row["tick_id"].');" ><span class="label label-pill label-warning">Sin Asignar</span><a/>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_asig"]);
                    foreach($datos1 as $row1 ){
                        $sub_array[] = '<span class="label label-pill label-success ">'.$row1["usu_nom"] .' </span>';  
                    }
                }

                //FECHA DE CIERRE-------------------------------------------------------------------------------------------------
                if ($row["fech_cierre"]==NULL){
                        $sub_array[] = '<span class="label label-pill label-default">Sin Terminar</span>';
                        }else{
                            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                        }


                if ($row["usu_cierre"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">Sin Terminar</span>';
                }else{
                    $datos1=$usuario->get_usuario_x_id($row["usu_cierre"]);
                    foreach($datos1 as $row1 ){
                        $sub_array[] = '<span class="label label-pill label-success ">'.$row1["usu_nom"].' </span>';  
                    }
                }
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                $date1 = date_create($row["fech_crea"]);
                $date2 = date_create($row["fech_asig"]);
                $date3 = date_create($row["fech_cierre"]);
                //FECHA DE ASIGNACION ------------------------------------------------------------------------------------------------
                if ($row["fech_asig"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-warning">No Asignado </span>';
                }else{
                    $sub_array[] = date_diff($date2, $date1)->format("%h h: %i m: %s s");
                }
               
                if ($row["fech_cierre"]==NULL){
                    $sub_array[] = '<span class="label label-pill label-danger">No ha sido resuelto </span>';
                    $sub_array[] = '<span class="label label-pill label-danger">No ha sido resuelto </span>';
                }else{

                    $sub_array[] = date_diff($date3, $date1)->format("%h h: %i m: %s s");
                    $sub_array[] = date_diff($date3, $date2)->format("%h h: %i m: %s s");
                }
              
                
                $sub_array[] = '<button type="button" onClick="ver('.$row["tick_id"].');"  id="'.$row["tick_id"].'" class="btn btn-inline btn-primary btn-sm ladda-button"><i class="fa fa-eye"></i></button>';
                $data[] = $sub_array;
                 
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
        break;
// ---------------------------------------------------------------  Listar Ticket Soporte  ----------------------------------------------------------------------------

        case "listardetalle":
            $datos=$ticket->listar_ticketdetalle_x_ticket($_POST["tick_id"]);
            ?>
                <?php
                    foreach($datos as $row){
                        ?>
                            <article class="activity-line-item box-typical">
                                <div class="activity-line-date">
                                    <?php echo date("d/m/Y", strtotime($row["fech_crea"]));?>
                                </div>
                                <header class="activity-line-item-header">
                                    <div class="activity-line-item-user">
                                        <div class="activity-line-item-user-photo">
                                            <a href="#">
                                                <img src="../../public/<?php echo $row['rol_id'] ?>.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="activity-line-item-user-name"><?php echo $row['usu_nom'].' '.$row['usu_ape'];?></div>
                                        <div class="activity-line-item-user-status">
                                            <?php 
                                                if ($row['rol_id']==1){
                                                    echo 'Usuario';
                                                }else{
                                                    echo 'Soporte';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </header>
                                <div class="activity-line-action-list">
                                    <section class="activity-line-action">
                                        <div class="time"><?php echo date("H:i:s", strtotime($row["fech_crea"]));?></div>
                                        <div class="cont">
                                            <div class="cont-in">
                                                <p>
                                                    <?php echo $row["tickd_descrip"];?>
                                                </p>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </article>
                        <?php
                    }
                ?>
            <?php
        break;

        case "mostrar":
            $datos=$ticket->listar_ticket_x_id($_POST["tick_id"]);  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["tick_id"] = $row["tick_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["cat_id"] = $row["cat_id"];

                    $output["tick_titulo"] = $row["tick_titulo"];
                    $output["tick_descrip"] = $row["tick_descrip"];

                    if ($row["tick_estado"]=="Abierto"){
                        $output["tick_estado"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["tick_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }

                    $output["tick_estado_texto"] = $row["tick_estado"];

                    $output["fech_crea"] = date("d/m/Y H:i:s", strtotime($row["fech_crea"]));
                    $output["fech_cierre"] = date("d/m/Y H:i:s", strtotime($row["fech_cierre"]));
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                    $output["cat_nom"] = $row["cat_nom"];
                }
                echo json_encode($output);
            }   
        break;

        case "insertdetalle":
            $ticket->insert_ticketdetalle($_POST["tick_id"],$_POST["usu_id"],$_POST["tickd_descrip"]);
        break;

        case "total":
            $datos=$ticket->get_ticket_total();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalabierto":
            $datos=$ticket->get_ticket_totalabierto();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;

        case "totalcerrado":
            $datos=$ticket->get_ticket_totalcerrado();  
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["TOTAL"] = $row["TOTAL"];
                }
                echo json_encode($output);
            }
        break;
//---------------------------------------------------------------------GRAFICOS---------------------------------------------------------------------------------------------------
        case "grafico":
            $datos=$ticket->get_ticket_grafico();  
            echo json_encode($datos);
        break;
//--------------------------------------------------------------------GRAFICOS TICKET ASIGNADOS-----------------------------------------------------------------------------------
        case "graficoasig":
            $datos=$ticket->get_ticket_grafico_asig();  
            echo json_encode($datos);
        break;
//--------------------------------------------------------------------GRAFICOS TICKET ABIERTOS ASIGNADOS--------------------------------------------------------------------------
        case "graficoabiert":
            $datos=$ticket->get_ticket_grafico_abierto_asig();  
            echo json_encode($datos);
        break;
//--------------------------------------------------------------------CORREO CUANDO SE CIERRA TICKET------------------------------------------------------------------------------
        case "closeticket":
            $datos=$ticket->get_email($_POST['tick_id']);  
            echo json_encode($datos);
        break;




    }
?>