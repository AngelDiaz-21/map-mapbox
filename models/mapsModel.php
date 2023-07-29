<?php
class mapsModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getHospitalsForMarkers(){
        try {
            $sql = 'SELECT * FROM tbl_hospitales';
            $query = $this->db->connect()->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getBedsData(){
        try {
            $sql = 'SELECT tbl_hospitales.hospital_nombre, tbl_hospitales.telefono, tbl_hospitales.informacion, camas.total_camas, camas.camas_ocupadas, camas.camas_disponibles FROM tbl_hospitales INNER JOIN camas ON tbl_hospitales.cama_ID_fk=camas.ID_cama';
            $query = $this->db->connect()->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getHospitalsForSelect(){
        try {
            $sql = 'SELECT id, hospital_nombre FROM tbl_hospitales ORDER BY hospital_nombre';
            $query = $this->db->connect()->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getHospitalsLatLng($id){
        try {
            $sql = 'SELECT hospital_latitud, hospital_longitud FROM tbl_hospitales WHERE id = :id LIMIT 1';
            $query = $this->db->connect()->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
?>