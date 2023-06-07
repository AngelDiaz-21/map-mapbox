<?php
    include_once('conexion.php');

    class Google extends Model {

        public function __construct(){
            parent::__construct();
        }
        //Se edito: Aqui cambiar el nombre de la base
        public function get_lat_lng($value){
            $sql = $this->db->query("SELECT hospital_latitud, hospital_longitud FROM tbl_hospitales WHERE hospital_id = '$value' LIMIT 1");
            $lat = 0;
            $lng = 0;
            foreach($sql as $key){
                $lat = $key['hospital_latitud'];
                $lng = $key['hospital_longitud'];
            }
            $array = array('lat' => $lat, 'lng' => $lng);
            return $array;
        }

       public function get_consulta_info($valor){
        $valor=$_POST['valor'];
            $jsondata = array();
 
            // $sql = mysqli_query($this->db,"SELECT telefono, direccion, informacion from maps_rutas.tbl_hospitales where hospital_id=$valor");
            // $sql = mysqli_query($this->db, "SELECT t1.hospital_nombre, t1.telefono, t1.direccion, t1.informacion, t2.total_camas, t2.camas_ocupadas, t2.camas_disponibles FROM maps_rutas.tbl_hospitales t1
            // INNER JOIN maps_rutas.camas t2 ON t1.cama_ID_fk=t2.ID_cama  and t2.ID_cama = $valor");
            $sql = mysqli_query($this->db, "SELECT t1.hospital_id, t1.hospital_nombre, t1.telefono, t1.direccion, t1.informacion, t2.total_camas, t2.camas_ocupadas, t2.camas_disponibles FROM tbl_hospitales t1
            INNER JOIN camas t2 ON t1.cama_ID_fk=t2.ID_cama  and t1.hospital_ID = $valor");
             
            $r=$sql;
            // $r=mysqli_query($this->db,$query);
            $resultados= mysqli_fetch_assoc($r);

             //Lo amarillo son los nombres como los tenemos en la Base de datos
            $totalCamas=$resultados['total_camas'];
            $camasOcupadas=$resultados['camas_ocupadas'];
            $camasDisponibles=$resultados['camas_disponibles'];
            $tel=$resultados['telefono'];
            $dire=$resultados['direccion'];
            $info=$resultados['informacion'];
            $id=$resultados['hospital_id'];

             //Lo amarillo son los nombres como los tenemos en la Base de datos
            // agregamos nuestros datos al array para retornarlos
            $jsondata['total_camas'] = $totalCamas;
            $jsondata['camas_ocupadas'] = $camasOcupadas;
            $jsondata['camas_disponibles'] = $camasDisponibles;
            $jsondata['telefono'] = $tel;
            $jsondata['direccion'] = $dire;
            $jsondata['informacion'] = $info;
            $jsondata['hospital_id'] = $id;
             
            // este header es para el retorno correcto de datos con json
             header('Content-type: application/json; charset=utf-8');
             return json_encode($jsondata);
       }

        //Se edito: Aqui cambiar el nombre de la base
        public function get_stores(){
            $sql = $this->db->query("SELECT hospital_id, hospital_nombre FROM tbl_hospitales ORDER BY hospital_nombre");

            $option = '';
            foreach ($sql as $key){
                $id = $key['hospital_id'];
                $name = $key['hospital_nombre'];
                $option .= '<option value="'.$id.'">'.$name.' - B</option>'; 
            }
            return $option;
        }

        public function save_insert($usser, $pass){
            $sql = "INSERT into login (usuario, password) values ('$usser', '$pass')";

            if(mysqli_query($this->db,$sql))
            {
                echo "<script> alert('Usuario registrado con exito: $usser'); window.location='index.php' </script>";
            }else 
            {
                echo "Error: ".$sql."<br>".mysqli_connect_error($this->db);
            }
        }
        public function inicia_sesion($usuario, $password){

            $sql = mysqli_query($this->db,"SELECT * FROM login WHERE usuario = '$usuario' AND password='$password'");

            $nr = mysqli_num_rows($sql);
            if($nr==1){
                echo "<script> alert('Bienvenido $usuario'); window.location='actualizar.php' </script>";
            }else{
                echo "<script> alert('Usuario no existe'); window.location='index.php' </script>";
            }
        }
        // Se edito: Se agrego está función para traer los datos de los hospitales para ponerlos como marcadores.
        public function tbl_datos_hospitales(){

        $sql = mysqli_query($this->db, "SELECT tbl_hospitales.hospital_nombre, tbl_hospitales.telefono, tbl_hospitales.informacion, camas.total_camas, camas.camas_ocupadas, camas.camas_disponibles FROM tbl_hospitales INNER JOIN camas ON tbl_hospitales.cama_ID_fk=camas.ID_cama");
        //    $sql = mysqli_query($this->db, "SELECT t1.hospital_nombre, t1.telefono, t1.informacion, t2.total_camas, t2.camas_ocupadas, t2.camas_disponibles FROM maps_rutas.tbl_hospitales t1
        //    INNER JOIN maps_rutas.camas t2 ON t1.cama_ID_fk=t2.ID_cama");

            // $resultado=mysqli_query($this->db,$sql);

            if(!$sql){
                var_dump(mysqli_error($this->db));
                exit;
            }

        //    echo "<div class='table-responsive'>";
            echo "<div id='tabala' class='row box'>";
                echo "<div class='col-lg-11'>";
                    echo "<table class='table'>
                            <thead class='thead-dark'>
                                <tr>
                                    <th scope='col'>Nombre</th>
                                    <th scope='col'>Telefono</th>
                                    <th scope='col'>Información</th>
                                    <th scope='col'>Camas totales</th>
                                    <th scope='col'>Camas ocupadas</th>
                                    <th scope='col'>Camas disponibles</th>
                                </tr>
                            </thead>
                            <tbody>";
        // ESTA PARTE TAMBIEN PUEDE SER DE LA SIGUIENTE MANERA SOLO QUE NO SE RECOMIENDA POR LA OPTIMIZACIÓN
        // while ($row = mysqli_fetch_array($sql)) {
        // EN CAMBIO LA SIGUIENTE MANERA SE RECOMIENDA
                            while ($row = mysqli_fetch_assoc($sql)) {
                                echo "<tr>";
                                echo "<td scope='col'>" . $row['hospital_nombre'] . "</td>";
                                echo "<td scope='col'>" . $row['telefono'] . "</td>";
                                echo "<td scope='col'>" . preg_replace('/\\\\u([\da-fA-F]{4})/', '&#x\1;', $row['informacion']) . "</td>";
                                echo "<td scope='col'>" . $row['total_camas'] . "</td>";
                                echo "<td scope='col'>" . $row['camas_ocupadas'] . "</td>";
                                echo "<td scope='col'>" . $row['camas_disponibles'] . "</td>";
                                // echo "<td id='output' scope='col'> </td>";
                                echo "</tr>";
                                }
                        echo "</tbody>
                    </table>";
                echo "</div>";
                echo "<div id='caja' class='col-lg-1'>";
                    echo "<table class='table'>";
                            echo "<thead class='thead-dark'>";
                                echo "<tr>";
                                    echo " <th scope='col'>Tiempo en llegar</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                                echo "<tr>";
                                    echo "<td class='box' id='output' scope='col'></td>";
                                echo "</tr>";
                            echo "</tbody>";
                    echo "</table>";
                echo "</div>";
            echo "</div>";
            
            mysqli_close($this->db);
        }

        public function dibujar_marcadores(){
            $sql = mysqli_query($this->db, "SELECT *FROM tbl_hospitales");
            // Seleccionamos los datos para crear los marcadores en el Mapa de Google serian direccion, lat y lng 
            // mysqli_fetch_array
            while ($row = mysqli_fetch_assoc($sql)) {
                echo '["' . $row['hospital_nombre'] . ', ' . $row['direccion'] . '", ' . $row['hospital_latitud'] . ', ' . $row['hospital_longitud'] . '],';
            }
        }

        public function info_marcadores(){

            $sql = mysqli_query($this->db, "SELECT * FROM tbl_hospitales");
            if($sql->num_rows > 0){
              
                while($row = $sql->fetch_assoc()){ ?>
                
                ['<div class="info_content">' + '<h3><?php echo $row['hospital_nombre']; ?></h3>' + '<p><?php echo $row['direccion']; ?></p>' + '</div>'],
            
                <?php }
            }
        }

        public function get_hospitales(){
            $sql = $this->db->query("SELECT hospital_id, hospital_nombre FROM tbl_hospitales ORDER BY hospital_nombre");

            $option = '';
            foreach ($sql as $key){
                $id = $key['hospital_id'];
                $name = $key['hospital_nombre'];
                $option .= '<option value="'.$id.'">'.$name.'</option>'; 
            }
            return $option;
        }

        public function prueba($valor){
            $valor=$_POST['valor'];
            $jsondata = array();
 
            //la consulta que necesites para trer el codigo y el nombre del cliente
            // $query="SELECT hospital_nombre,telefono from maps_rutas.tbl_hospitales where hospital_id=$valor";
            // $query="Select hospital_nombre,telefono from tbl_hospitales where hospital_id=$valor";
            // $sql = mysqli_query($this->db, "SELECT t1.hospital_nombre, t1.telefono, t1.informacion, t2.total_camas, t2.camas_ocupadas, t2.camas_disponibles FROM maps_rutas.tbl_hospitales t1
            // INNER JOIN maps_rutas.camas t2 ON t1.cama_ID_fk=t2.ID_cama");
            // $query = mysqli_query($this->db,"Select hospital_nombre,telefono from tbl_hospitales where hospital_id=$valor");
            $query = mysqli_query($this->db,"SELECT hospital_nombre,telefono from maps_rutas.tbl_hospitales where hospital_id=$valor");

        
            $r=$query;
            // $r=mysqli_query($this->db,$query);
            $resultados= mysqli_fetch_assoc($r);
            
            $nombre=$resultados['hospital_nombre'];
            $codigo=$resultados['telefono'];

            // echo "<input type='text' class='loquesea' value="  .$resultados['hospital_nombre'].">";
            // echo "<input type='text' class='loquesea' value="  .$resultados['hospital_nombre'].">";
            
            // agregamos nuestros datos al array para retornarlos
            $jsondata['nombre'] = $nombre;
            $jsondata['telefono'] = $codigo;
            
            // este header es para el retorno correcto de datos con json
            header('Content-type: application/json; charset=utf-8');
            return json_encode($jsondata);

            




        }

        public function actualizar_datos($ID_hospital, $total_camas, $camas_ocupadas, $camas_disponibles, $telefono, $direccion, $informacion ){
            //  $sql = "INSERT into maps_rutas.login (usuario, password) values ('$usser', '$pass')";

            $sql = "UPDATE tbl_hospitales INNER JOIN camas ON  (tbl_hospitales.cama_ID_fk=camas.ID_cama) SET camas.total_camas='$total_camas', camas.camas_ocupadas='$camas_ocupadas', camas.camas_disponibles='$camas_disponibles', tbl_hospitales.telefono='$telefono', tbl_hospitales.direccion='$direccion', tbl_hospitales.informacion='$informacion' WHERE  tbl_hospitales.hospital_id='$ID_hospital' and camas.ID_cama=$ID_hospital";

            // ON t1.cama_ID_fk=t2.ID_cama  and t1.hospital_ID = $valor


            if(mysqli_query($this->db,$sql))
            {
                return "<script> alert('Datos actualizados con exito: ') window.location='index.php' </script>";
            }else 
            {
                return "Error: ".$sql."<br>".mysqli_connect_error($this->db);
            }
        }

        public function registrar_hospital($nombre_hospital, $telefono, $latitud, $longitud, $total_camas, $camas_ocupadas, $camas_disponibles, $direccion, $informacion){

            $SQL = "INSERT INTO camas (total_camas, camas_ocupadas, camas_disponibles) VALUES ('$total_camas', '$camas_ocupadas', '$camas_disponibles')";

            $result = mysqli_query($this->db,$SQL);
            $ultimo_id = mysqli_insert_id($this->db);

            $SQL1 = "INSERT INTO tbl_hospitales (hospital_nombre, telefono, hospital_latitud, hospital_longitud, direccion, informacion, cama_ID_fk) VALUES ('$nombre_hospital', '$telefono', '$latitud', '$longitud', '$direccion', '$informacion', (SELECT MAX(ID_cama) FROM camas))";
            // $SQL1 = "INSERT INTO tbl_hospitales (hospital_nombre, telefono, hospital_latitud_, hospital_longitud, direccion, informacion, cama_ID_fk) VALUES ('$nombre_hospital', '$telefono', '$latitud', '$longitud', '$direccion', '$informacion', '$ultimo_id')";

            $result = mysqli_query($this->db, $SQL1);

        }
    }
    if(isset($_POST['value'])){
        $class = new Google;
        $run = $class->get_lat_lng($_POST['value']);
        exit(json_encode($run));
    }
    if(isset($_POST['usser'], $_POST['pass'])){
        $class = new Google;
        $cor = $class->save_insert($_POST['usser'], $_POST['pass']);
        // La parte del sha1 se ocupa para encriptar la contraseña
        // $cor = $class->save_insert($_POST['usser'], sha1($_POST['pass'])  );
        exit(json_encode($cor));
    }

    if(isset($_POST['usuario'], $_POST['password'])){
        $class = new Google;
        $cer = $class->inicia_sesion($_POST['usuario'], $_POST['password']);
        exit(json_encode($cer));
    }

    if(isset($_POST['valor'])){
        $class = new Google;
        $car = $class->get_consulta_info($_POST['valor']);
        exit(json_encode($car));
    }

    if(isset($_POST['valor'])){
        $class = new Google;
        $cir = $class->prueba($_POST['valor']);
        exit(json_encode($cir));
    }

    if(isset($_POST['ID_hospital'],$_POST['total_camas'], $_POST['camas_ocupadas'], $_POST['camas_disponibles'], $_POST['telefono'], $_POST['direccion'], $_POST['informacion'])){
        $class = new Google;
        $aux = $class->actualizar_datos($_POST['ID_hospital'], $_POST['total_camas'], $_POST['camas_ocupadas'], $_POST['camas_disponibles'], $_POST['telefono'], $_POST['direccion'], $_POST['informacion']);
        exit(json_encode($aux));
    }

    if(isset($_POST['nombre_hospital'],$_POST['telefono'], $_POST['latitud'], $_POST['longitud'], $_POST['total_camas'], $_POST['camas_ocupadas'], $_POST['camas_disponibles'], $_POST['direccion'], $_POST['informacion'])){
        $class = new Google;
        $auxiliar = $class->registrar_hospital($_POST['nombre_hospital'],$_POST['telefono'], $_POST['latitud'], $_POST['longitud'], $_POST['total_camas'], $_POST['camas_ocupadas'], $_POST['camas_disponibles'], $_POST['direccion'], $_POST['informacion']);
        exit(json_encode($auxiliar));
    }




?>