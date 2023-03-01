<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$cat_id,$tick_titulo,$tick_descrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id,usu_id,cat_id,tick_titulo,tick_descrip,tick_estado,fech_crea,est) VALUES (NULL,?,?,?,?,'Abierto',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $cat_id);
            $sql->bindValue(3, $tick_titulo);
            $sql->bindValue(4, $tick_descrip);
            $sql->execute();
            //DOCUMENTOS
            $sql1="select last_insert_id() as 'tick_id';";
            $sql1= $conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql2='SELECT 
                    tm_ticket.tick_id,
                    tm_ticket.usu_id,
                    tm_ticket.cat_id,
                    tm_ticket.tick_titulo,
                    tm_ticket.tick_descrip,
                    tm_ticket.tick_estado,
                    tm_ticket.fech_crea,
                    tm_ticket.usu_asig,
                    tm_ticket.fech_asig,
                    tm_ticket.fech_cierre,
                    tm_ticket.usu_cierre,
                    tm_usuario.usu_nom,
                    tm_usuario.usu_ape,
                    tm_categoria.cat_nom
                    -- (SELECT TIMESTAMPDIFF(minute, tm_ticket.fech_crea, tm_ticket.fech_asig)) as timeA,
                    -- (SELECT TIMESTAMPDIFF(minute, tm_ticket.fech_crea, tm_ticket.fech_cierre)),
                    -- (SELECT TIMESTAMPDIFF(minute, tm_ticket.fech_asig, tm_ticket.fech_cierre))
                    -- (SELECT IF(tm_ticket.fech_asig IS NULL, "Aun no ha sido asignado", (SELECT TIMESTAMPDIFF(second, tm_ticket.fech_crea, tm_ticket.fech_asig)))) AS timeA,
                    -- (SELECT IF(tm_ticket.fech_cierre IS NULL, "Aun no ha sido resuelto", (SELECT TIMESTAMPDIFF(second, tm_ticket.fech_crea, tm_ticket.fech_cierre)))) AS timeE,
                    -- (SELECT IF(tm_ticket.fech_cierre IS NULL AND tm_ticket.fech_asig IS NULL, "Aun no ha sido resuelto y asignado", (SELECT TIMESTAMPDIFF(second, tm_ticket.fech_asig, tm_ticket.fech_cierre)))) AS timeEA
                FROM 
                    tm_ticket
                    INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                    INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                    tm_ticket.est = 1 AND 
                    tm_usuario.usu_id=?
            ';
            // =============================    SQL 1   =====================================
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_ticket.fech_cierre,
                tm_ticket.usu_cierre,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_usuario.usu_id=?";
            // =============================    SQL 1   =====================================

            $sql2=$conectar->prepare($sql2);
            $sql2->bindValue(1, $usu_id);
            $sql2->execute();
            return $resultado=$sql2->fetchAll();
        }


        public function listar_ticket_x_id($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id,
                tm_ticket.usu_id,
                tm_ticket.cat_id,
                tm_ticket.tick_titulo,
                tm_ticket.tick_descrip,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_ticket.fech_cierre,
                tm_ticket.usu_cierre,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_categoria.cat_nom
                FROM 
                tm_ticket
                INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
                INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                AND tm_ticket.tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            tm_ticket.tick_id,
            tm_ticket.usu_id,
            tm_ticket.cat_id,
            tm_ticket.tick_titulo,
            tm_ticket.tick_descrip,
            tm_ticket.tick_estado,
            tm_ticket.fech_crea,
            tm_ticket.usu_asig,
            tm_ticket.fech_asig,
            tm_ticket.fech_cierre,
	        tm_ticket.usu_cierre,
            tm_usuario.usu_nom,
            tm_usuario.usu_ape,
            tm_categoria.cat_nom
            FROM 
            tm_ticket
            INNER join tm_categoria on tm_ticket.cat_id = tm_categoria.cat_id
            INNER join tm_usuario on tm_ticket.usu_id = tm_usuario.usu_id
            WHERE
            tm_ticket.est = 1";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                td_ticketdetalle.tickd_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM 
                td_ticketdetalle
                INNER join tm_usuario on td_ticketdetalle.usu_id = tm_usuario.usu_id
                WHERE 
                tick_id =?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
            $conectar= parent::conexion();
            parent::set_names();

            /* TODO:Obtener usuario asignado del tick_id */
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach ($datos as $row){
                $usu_asig = $row["usu_asig"];
                $usu_crea = $row["usu_id"];
            }

            /* TODO: si Rol es 1 = Usuario insertar alerta para usuario soporte */
            if ($_SESSION["rol_id"]==1){
                /* TODO: Guardar Notificacion de nuevo Comentario */
                $sql0="INSERT INTO tm_notificacion (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null, $usu_asig ,'Tiene una nueva respuesta del usuario con nro de ticket : ',$tick_id,2)";
                $sql0=$conectar->prepare($sql0);
                $sql0->execute();
            /* TODO: Else Rol es = 2 Soporte Insertar alerta para usuario que genero el ticket */
            }else{
                /* TODO: Guardar Notificacion de nuevo Comentario */
                $sql0="INSERT INTO tm_notificacion (not_id,usu_id,not_mensaje,tick_id,est) VALUES (null,$usu_crea,'Tiene una nueva respuesta de soporte del ticket Nro : ',$tick_id,2)";
                $sql0=$conectar->prepare($sql0);
                $sql0->execute();
            }

            $sql="INSERT INTO td_ticketdetalle (tickd_id,tick_id,usu_id,tickd_descrip,fech_crea,est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();

            /* TODO: Devuelve el ultimo ID (Identty) ingresado */
            $sql1="select last_insert_id() as 'tickd_id';";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
        }

        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar= parent::conexion();
            parent::set_names();
                $sql="call sp_i_ticketdetalle_01(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                  
                    tick_estado = 'Cerrado'
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        
        public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    usu_asig = ?,
                    fech_asig = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion_cierre($tick_id,$usu_cierre){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="update tm_ticket 
                set	
                    usu_cierre=?,
                    fech_cierre = now()
                where
                    tick_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_cierre);
            $sql->bindValue(2, $tick_id);
          
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM tm_ticket where tick_estado='Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_grafico(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_categoria.cat_nom as nom,COUNT(*) AS total
                FROM   tm_ticket  JOIN  
                    tm_categoria ON tm_ticket.cat_id = tm_categoria.cat_id  
                WHERE    
                tm_ticket.est = 1
                GROUP BY 
                tm_categoria.cat_nom 
                ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_grafico_asig(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT tm_usuario.usu_nom as Nombre,COUNT(*) AS total
            FROM   tm_ticket  JOIN  
                tm_usuario ON tm_ticket.usu_asig = tm_usuario.usu_id  
            WHERE    
            tm_ticket.est = 1
            GROUP BY 
            tm_usuario.usu_nom 
            ORDER BY total DESC;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_ticket_grafico_abierto_asig(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                    tm_usuario.usu_nom as Nombre,
                    COUNT(*) AS total
                FROM   
                    tm_ticket  
                        JOIN  
                            tm_usuario ON tm_ticket.usu_asig = tm_usuario.usu_id  
                WHERE    
                    tm_ticket.tick_estado = 'Abierto'
                GROUP BY 
                    tm_usuario.usu_nom 
                ORDER BY total DESC;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_email($tick_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
                    CONCAT(usua.usu_nom,' ',usua.usu_ape) AS Nombre, 
                    usua.usu_correo
                FROM 
                    tm_ticket AS ticket,
                    tm_usuario AS usua
                WHERE
                    ticket.usu_id = usua.usu_id AND 
                    ticket.tick_id=".$tick_id;
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }



    }
?>