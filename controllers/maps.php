<?php
class Maps extends Controller{
    function __construct(){
        parent::__construct();
    }

    function index(){
        $this->view->render('maps/index');
    }

    public function showDrawRoute(){
        $this->view->render('maps/drawRoute');
    }

    function getHospitalsForMarkers(){
        $markers = $this->model->getHospitalsForMarkers();

        if(!$markers){
            echo json_encode([]);
        }else{
            echo json_encode($markers);
        }
    }

    public function getBedsData(){
        $beds = $this->model->getBedsData();
        
        if(!$beds){
            echo json_encode([]);
        }else{
            include 'libs/bedTable.php';
            $table = generateTable($beds);
            echo $table;
        }
    }

    public function getHospitalsForSelect() {
        $nameHospitals = $this->model->getHospitalsForSelect();
    
        if (!$nameHospitals) {
            echo json_encode([]);
        } else {
            echo json_encode($nameHospitals);
        }
    }

    public function getHospitalsLatLng(){
        $id = $_POST['id_hospital'];
        $HospitalslatLng = $this->model->getHospitalsLatLng($id);

        if (!$HospitalslatLng) {
            echo json_encode([]);
        } else {
            echo json_encode($HospitalslatLng);
        }
    }
}
?>