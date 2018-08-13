<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/libraries/simple_html_dom.php';
class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       // $this->load->library('simple_html_dom');
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
	public function index()
	{
//        $this->load->database();
//        $username = $this->db->query('select * from user;')->result();
//        echo js$username;die;
		$this->load->view('form');
	}

	public function form(){
	    $username = $this->input->get('user_id');
	    $url = $this->input->get('url');

	    $shop = $this->divideUrl($url);

	    $result = $this->tree($shop);

	    echo $result;

    }

    public function divideUrl($url=null){

	    $array['url'] = $url;
	    $array['shop'] = null;
        return $array;
    }

    public function tree($shop){
        $html = new simple_html_dom();

        $html->load_file($shop['url']);

        $ret = $html->find('.buyBtn soldOut');
        $ret1 = $html->find('.buyBtn');
//        echo json_encode($ret);
//        echo '============='.json_encode($ret1);die;
        $html->clear();
        if($ret1&& !$ret){
            return '有货';
        }else{
            return '断货';
        }
    }
}
