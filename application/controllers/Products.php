<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 function products(){
        parent::__construct();
		$this->load->model('products_model');
		
		//$this->load->model('bid_management_mod');
    }
	 
	public function index()
	{
		
	     $data["active_users"] = $this->products_model->getactiveuser();
	     $data["active_prduct_user"] = $this->products_model->getactiveproductuser();
	     $data["active_product"] = $this->products_model->getactiveproduct();
	     $data["active_product_nu"] = $this->products_model->getactiveproductnouser();
	     $data["product_quantity"] = $this->products_model->getactiveproductamount();
	     $data["product_price"] = $this->products_model->getactiveproductprice();
	     $data["user_product_price"] = $this->products_model->getactiveuserproductprice();
	     $data["ExchangeRate"] =   $this->products_model->geExchangeRate();
		
	
		
		$this->load->view('products',$data);
	}
	
	
	

	
}
