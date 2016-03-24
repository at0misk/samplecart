<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->enable_profiler();
	}
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		if(!$this->session->userdata('ordered')){
			$this->session->userdata('ordered', ' ');
		}
		if(!$this->session->userdata('cart') && !$this->session->userdata('cartB')){
			$cartArr = [];
			$this->session->set_userdata('cart', $cartArr);
			$this->session->set_userdata('cartB', $cartArr);
		}
		if(!$this->session->userdata('submitted')){
			$this->session->set_userdata('submitted', ' ');
		}
		if(!$this->session->userdata('count')){
			$this->session->set_userdata('count', 0);
		}
		$this->load->model('Product');
		$arr['products'] = $this->Product->get_all_products();
		$this->load->view('productsView', $arr);
	}
	public function DojoShirt(){
		if(!$this->session->userdata('shirtQty')){
		$SQty = $this->input->post('qty');
		// $QtyArr = ["Qty" => $SQty];
		$this->session->set_userdata('shirtQty', $SQty);
		$tempArr = $this->session->userdata('cart');
		$this->load->model('Product');
		$productShirt = array('Dojo Shirt');
		$shirt = $this->Product->get_product_by_description($productShirt);
		// array_push($shirt, $QtyArr);
		$shirt['qty'] = $SQty;
		// array_push($shirt, $SQty);
		array_push($tempArr, $shirt);
		// var_dump($tempArr);
		// var_dump($this->session->userdata('shirtQty'));
		// die();
		$this->session->set_userdata('cart', $tempArr);
		$this->session->set_userdata('submitted', 'Added to cart!');
		$tempCount = $this->session->userdata('count');
		$this->session->set_userdata('count', $tempCount+$SQty);
		redirect('/');
		}
		else{
		$tempArr = $this->session->userdata('cart');
		foreach ($tempArr as $value) {
			$oldQty = $value['qty'];
		}
		$tempQty = $this->input->post('qty');
		$newQty = $oldQty+$tempQty;
		$tempArr[0]['qty'] = $newQty;
		$this->session->set_userdata('cart', $tempArr);
		// var_dump($tempArr);
		// die();
		// $tempArr['qty'] += $tempQty;
		$this->session->set_userdata('submitted', 'Added to cart!');
		$tempCount = $this->session->userdata('count');
		$this->session->set_userdata('count', $tempCount+$tempQty);
		redirect('/');
		}
	}
	public function DojoCups(){
		if(!$this->session->userdata('shirtQtyB')){
		$SQty = $this->input->post('qty');
		$this->session->set_userdata('shirtQtyB', $SQty);
		$tempArr = $this->session->userdata('cartB');
		$this->load->model('Product');
		$productShirt = array('Dojo Cups');
		$cup = $this->Product->get_product_by_description($productShirt);
		$cup['qty'] = $SQty;
		array_push($tempArr, $cup);
		$this->session->set_userdata('cartB', $tempArr);
		$this->session->set_userdata('submitted', 'Added to cart!');
		$tempCount = $this->session->userdata('count');
		$this->session->set_userdata('count', $tempCount+$SQty);
		redirect('/');
		}
		else{
		$tempArr = $this->session->userdata('cartB');
		foreach ($tempArr as $value) {
			$oldQty = $value['qty'];
		}
		$tempQty = $this->input->post('qty');
		$newQty = $oldQty+$tempQty;
		$tempArr[0]['qty'] = $newQty;
		$this->session->set_userdata('cartB', $tempArr);
		// var_dump($tempArr);
		// die();
		// $tempArr['qty'] += $tempQty;
		$this->session->set_userdata('submitted', 'Added to cart!');
		$tempCount = $this->session->userdata('count');
		$this->session->set_userdata('count', $tempCount+$tempQty);
		redirect('/');
		}
	}
	public function CartDelB(){
		$this->session->set_userdata('count', 0);
		$this->session->set_userdata('cartB', []);
		$this->session->set_userdata('shirtQtyB' , NULL);
		$this->session->set_userdata('submitted', ' ');
		redirect('products/Cart');
	}
	public function CartDel(){
		$this->session->set_userdata('count', 0);
		$this->session->set_userdata('cart', []);
		$this->session->set_userdata('shirtQty' , NULL);
		redirect('products/Cart');
		$this->session->set_userdata('submitted', ' ');
	}
	public function Cart(){
		$this->load->view('cartView');
	}
	public function ordered(){
		$this->session->set_userdata('ordered', 'Thanks for ordering!');
		redirect('products/Cart');
	}
}