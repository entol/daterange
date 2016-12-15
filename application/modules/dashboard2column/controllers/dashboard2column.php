<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard2column extends MX_Controller
{

 	/**
	 * @author entol
	 * @see more  http://www.entol.net
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('form_validation');
		//$this->load->model('dn_model');
		$this->meta = array(
            'activeMenu' => 'dashboard',
            'activeTab' => 'dashboard'
        );
	}

    public function index()
    {
       $this->load->helper('xcrud');
        $meta = $this->meta;
       	
		 $this->load->helper('xcrud');
		 
        $xcrud = xcrud_get_instance('tomorow');
        	
        $xcrud->table('tomorrow');
        
	
	$xcrud->columns('customer,material,qty,notes,delivery_status,vehicle_number');
	$xcrud->search_columns('date');
        $xcrud->highlight('delivery_status', '=',"Reschedule",'ff851b','text-bold text-white bg-purple');
        $xcrud->highlight('delivery_status', '=',"Return",'ff851b','text-bold text-white bg-blue');
         $xcrud->highlight('delivery_status', '=',"Loading",'ff851b','text-bold text-white bg-orange');
         $xcrud->highlight('delivery_status', '=',"Plan",'ff851b','text-bold text-white bg-green');
         $xcrud->highlight('delivery_status', '=',"In_Transit",'ff851b','text-bold text-white bg-#8DED79');
			$xcrud->highlight_row('delivery_status', '=',"Delivered",'white','text-bold text-white bg-aqua');
			$xcrud->highlight_row('delivery_status', '=',"Cancel",'white','text-bold text-white bg-red');
         $xcrud->table_name('Delivery Schedule');
        $xcrud->search_columns('productVendor,quantityInStock,buyPrice','quantityInStock');
		$xcrud->unset_csv();
		$xcrud->limit(30);
		//$xcrud->unset_numbers();
		//$xcrud->unset_pagination();
		$xcrud->unset_print();
		//$xcrud->unset_search();
		$xcrud->unset_title();
		//$xcrud->unset_sortable();
		//$xcrud->benchmark(false);
         $xcrud->unset_title('remove');
        $data['content'] = $xcrud->render();
        
        //=============================
        
         $today = xcrud_get_instance('today');
        $today->table('todays');
        
        $today->columns('customer,material,qty,notes,delivery_status,vehicle_number');
		$today->search_columns('date');
        $today->highlight('delivery_status', '=',"Reschedule",'ff851b','text-bold text-white bg-purple');
        $today->highlight('delivery_status', '=',"Return",'ff851b','text-bold text-white bg-blue');
         $today->highlight('delivery_status', '=',"Loading",'ff851b','text-bold text-white bg-orange');
         $today->highlight('delivery_status', '=',"Plan",'ff851b','text-bold text-white bg-green');
         $today->highlight('delivery_status', '=',"In_Transit",'ff851b','text-bold text-white bg-#8DED79');
			$today->highlight_row('delivery_status', '=',"Delivered",'white','text-bold text-white bg-aqua');
			$today->highlight_row('delivery_status', '=',"Cancel",'white','text-bold text-white bg-red');
         $today->table_name('Delivery Schedule');
         
		$today->unset_edit();
		$today->unset_remove();
		$today->unset_view();
		$today->unset_csv();
		$today->limit(30);
		//$today->unset_numbers();
		//$today->unset_pagination();
		$today->unset_print();
		//$today->unset_search();
		$today->unset_title();
		
        $data['today'] = $today->render();
        

				$meta = $this->meta;
    		$this->load->view('commons/header',$meta);
        $this->load->view('dashboard2',$data);
        $this->load->view('commons/footer');
    }
function by_date(){
		$par1= $_GET['par1'];
		$par2= $_GET['par2'];
		//echo $par1;
		$tgl1 = explode("/", $par1);
		$tgl1 = $tgl1[2] . '-' . $tgl1[0] . '-' .  $tgl1[1];
		$tgl2 = explode("/", $par2);
		$tgl2 = $tgl2[2] . '-' . $tgl2[0] . '-' .  $tgl2[1];
		echo "<b><i>Data From </b></i>".$tgl1." "."00:00:00"."<b><i> To  </b></i>".$tgl2." "."23:59:59" ;
		//echo $tgl1;
		$this->load->helper('entol');
        $dashboard = xcrud_get_instance('dashboard');
        $dashboard->table('dashboard');
        $dashboardwhere = "date BETWEEN '$tgl1' AND '$tgl2'";
    	$dashboard->where("", "{$dashboardwhere}");
        $dashboard->unset_edit();
		$dashboard->unset_remove();
		$dashboard->unset_view();
		$dashboard->unset_csv();
		$dashboard->highlight('delivery_status', '=',"Reschedule",'ff851b','text-bold text-white bg-purple');
        $dashboard->highlight('delivery_status', '=',"Return",'ff851b','text-bold text-white bg-blue');
        $dashboard->highlight('delivery_status', '=',"Loading",'ff851b','text-bold text-white bg-orange');
        $dashboard->highlight('delivery_status', '=',"Plan",'ff851b','text-bold text-white bg-green');
        $dashboard->highlight('delivery_status', '=',"In_Transit",'ff851b','text-bold text-white bg-#8DED79');
	$dashboard->highlight_row('delivery_status', '=',"Delivered",'white','text-bold text-white bg-aqua');
	$dashboard->highlight_row('delivery_status', '=',"Cancel",'white','text-bold text-white bg-red');
      
		$dashboard->limit(30);
		//$today->unset_numbers();
		//$today->unset_pagination();
		$dashboard->unset_print();
		
		
        $data['as'] = $dashboard->render();
		echo $data['as']; 
		
		}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
