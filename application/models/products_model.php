<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

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
	 
		function Products_model(){
        parent::__construct();
		
    }
	
	 
	public function getactiveuser()
	{
		$query = $this->db->query("select count(*) as total_user from users where status='active' and verified='yes' ");
		return $query->row_array();
	}
	
    public function getactiveproductuser()
	{
		$query = $this->db->query("select count(u.userid) as total_user from users as u,users_products as up,products as  p
		where u.status='active' and u.verified='yes' and up.user_id =u.userid and p.id=up.products_id and p.status='activated' ");
		return $query->row_array();
	}
	
	public function getactiveproduct()
	{
		$query = $this->db->query("select count(*) as total_product from products where status='activated' ");
		return $query->row_array();
	}
	
	  public function getactiveproductnouser()
	{
		$query = $this->db->query("select count(p.id) as total_product from users_products as up,products as  p
		where p.id != up.products_id  ");
		return $query->row_array();
	}
	
	  public function getactiveproductamount()
	{
		$query = $this->db->query("select sum(up.quantity) as total_quantity from users_products as up,products as  p
		where p.id = up.products_id  and p.status='activated' ");
		return $query->row_array();
	}
	
	
	  public function getactiveproductprice()
	{
		$query = $this->db->query("select sum(up.price) as total_price from users_products as up,products as  p
		where p.id = up.products_id  and p.status='activated' ");
		return $query->row_array();
	}
	
	  public function getactiveuserproductprice()
	{
		$query = $this->db->query("select u.username,sum(up.price) as total_price from users as u,users_products as up,products as  p
		where  up.user_id =u.userid and p.id=up.products_id and p.status='activated' group by u.userid ");
		return $query->result_array();
	}
	
	
	public function geExchangeRate()
	{
	          $curl = curl_init();

				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.apilayer.com/exchangerates_data/latest?base=USD&symbols=RON,USD",
				  CURLOPT_HTTPHEADER => array(
					"Content-Type: text/plain",
					"apikey: wE3FeMyQp414VjQgYNjhg09eWS2EFuhZ"
				  ),
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET"
				));

				$response = curl_exec($curl);

				curl_close($curl);
				//echo $response;
				
				
				$exchange_data_array =  json_decode($response,true);
				
				
				//print_r($exchange_data_array);
				
				return ($exchange_data_array['rates']['USD']." USD= ".$exchange_data_array['rates']['RON']." RON");

	
	}
	
	
	
	
	
	
	
	
}
