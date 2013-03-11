<?php
/**
 * User: hungdp
 * Date: 3/8/13
 * Time: 3:04 PM
 */
class customers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('base');
        $this->load->library('upload');
        $this->base->checkRoles();  
        $this->load->database();
        $this->Model = new Model;
        $this->load->library('base');  
        $this->base->checkRoles();
    }

    public function index()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Quản trị danh sách khách hàng';
        $data['customers'] = $this->Model->get_data('customers');
        $data['count'] = $data['customers']->num_rows();
        $data['content'] = 'customers/list_customers_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function add customer
     */
    public function add()
    {
        $data = $this->base->base_data();
        $data['title'] = 'Thêm khách hàng mới';
        $data['operator'] = $this->Model->get_data('operator');
        $data['content'] = 'customers/form_customers_view';
        $this->load->view('master_view', $data);
    }

    /**
     * Function edit customer
     * @param $id
     */
    public function edit($id)
    {
        $data = $this->base->base_data();
        $data['customer'] = $this->Model->get_one('customers', 'customer_id', $id);
        $data['operator'] = $this->Model->get_data('operator');
        $data['title'] = 'Sửa khách hàng ' . $data['customer']->row()->customer_name ;
        $data['content'] = 'customers/form_customers_view';
        $this->load->view('master_view', $data);
    }

     /**
     * Function action add or edit customer
     * @param null $customer_id
     */
    function action_customer($customer_id = NULL)
    {   $data = $this->base->base_data(); 
        $type = $this->input->post('type');
        $user_id = $this->session->userdata('sessionIdAdmin');
        if($type == 1){
            $customer_name = $this->input->post('customer_name');
            $customer_mobile = $this->input->post('customer_mobile');
            $operator_id = $this->input->post('operator_id');
            $data = array('customer_name' => $customer_name, 'customer_mobile' => $customer_mobile, 'operator_id' => $operator_id, 'user_id' =>$user_id);
            if (!isset($customer_id)) {
                 $this->Model->insert('customers', $data);
            } else {
                 $this->Model->update('customer_id', $customer_id, 'customers', $data);
            }
        }elseif($type == 3){
                #BEGIN TYPE = FILE TXT
            $file = $this->base->do_upload();
            
            if(isset($file['upload_data']['full_path'])&&$file['upload_data']['file_ext']=='.txt'){
                $v = file($file['upload_data']['full_path']); 
                $invalid=0;
                $success = 0;
                $duplicate = 0;
                foreach ($v as $line) {
                    $txt = explode("|", $line);
                    $customer_name = trim($txt[0]);
                    $custom_mobile = trim($txt[1]);
                    //check validate mobile
                    if (!preg_match('/^84/', $custom_mobile)){
                            if (!preg_match('/^0/', $custom_mobile)){
                                $custom_mobile = "84".$custom_mobile;
                            }
                            else {
                                $custom_mobile = preg_replace('/^0/','84', $custom_mobile);
                            }
                        }
                        
                    if (preg_match('/^849(0|1|2|3|4|5|6|7|8)[0-9]{7}$/', $custom_mobile) or preg_match('/^8499(3|4|5|6)[0-9]{6}$/', $custom_mobile) or 
                            preg_match('/8412[0-9][0-9]{7}$/', $custom_mobile) or preg_match('/^8416(2|3|4|5|6|7|8|9)[0-9]{7}$/', $custom_mobile) or 
                            preg_match('/^84199[0-9]{7}$/', $custom_mobile)){
                                $mobile = $custom_mobile;
                    }else{
                            $mobile = '';
                            $invalid++; 
                    }
                    $operator_id = '';
                    if(isset($txt[2])&&trim($txt[2])!=''){
                         $operator_info = $this->Model->getData('operator',array('operator_name'=>trim($txt[2])));
                         if(count($operator_info)!=0){
                            $operator_id = $operator_info[0]['operator_id'];
                        }
                    }
                    if($mobile!=''){
                        $insert = array('customer_name' => $customer_name, 'customer_mobile' => $mobile, 'operator_id' => $operator_id, 'user_id' =>$user_id);
                        $effect = $this->Model->insert('customers',$insert);
                        if($effect>0){
                            $success++;
                        }else{
                            $duplicate++;
                        }
                    }
                    
                }
                
                unlink($file['upload_data']['full_path']);
                $data['info'] = array('success'=>$success,'duplicate'=>$duplicate,'invalid'=>$invalid);
                $data['content'] = 'customers/upload_info_view';
                $data['link_back'] = base_url().'customers';
                #END TYPE = FILE TXT
            }else{
                $data['error_info'] = 'Bạn cần upload file text, upload thất bại!';
                  $data['title'] = 'Error upload';
                  $data['link_back'] = base_url().'customers/add';
                  $data['content'] = 'information_view';
            }
            $this->load->view('master_view', $data);
            return;
        }else{
             #BEGIN TYPE = FILE excel
            $file = $this->base->do_upload();  
            if(isset($file['upload_data']['full_path'])&&$file['upload_data']['file_ext']=='.xls'){
                $filename = $file['upload_data']['file_name'];
                $data['info'] = $this->import_customers_xls($filename); 
                $data['content'] = 'customers/upload_info_view';
                $data['title'] = 'Information';
                $data['link_back'] = base_url().'customers';
                #END TYPE = FILE excel
            }else{
                  $data['error_info'] = 'Bạn cần upload file excel, upload thất bại!';
                  $data['title'] = 'Error upload';
                  $data['link_back'] = base_url().'customers/add';
                  $data['content'] = 'information_view'; 
                   
            }
            $this->load->view('master_view', $data);
            return;
        }
        redirect(base_url() . 'customers', 'location');
    }

    /**
     *Function delete customer
     * @param $customer_id
     */
    function delete($customer_id)
    {
        $this->Model->delete('customers', 'customer_id', $customer_id);
        redirect(base_url() . 'customers', 'location');
    }
    
    /**
    * read file excel from upload file
    */
    public function import_customers_xls($file_name){
        set_time_limit(0);                                                                                    
        include $_SERVER['DOCUMENT_ROOT'].'/application/my_classes/Classes/PHPExcel.php';
        include $_SERVER['DOCUMENT_ROOT'].'/application/my_classes/Classes/PHPExcel/Writer/Excel5.php';
        include $_SERVER['DOCUMENT_ROOT'].'/application/my_classes/Classes/Reader_Filter.php';
        $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp; $cacheSettings = array( 'memoryCacheSize' => '8MB' ); 
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
        $objReader = new PHPExcel_Reader_Excel5();
        $objReader->setReadDataOnly(true);
        
        $file_path = $_SERVER['DOCUMENT_ROOT'].'/public/import/';
        //$file_path = $_SERVER['DOCUMENT_ROOT'].'/smsloyalty/www/public/import/';
        
        $chunkSize = 2000;
        $chunkFilter = new chunkReadFilter();
        
        /**  Tell the Reader that we want to use the Read Filter that we've Instantiated  **/
        $objReader->setReadFilter($chunkFilter);
        $i = 0;
        $data = array();
        $invalid = 0;
        $success = 0;
        $duplicate = 0;
        for ($startRow = 2; $startRow <= 30000; $startRow += $chunkSize) {
            //$chunkFilter->setRows($startRow,$chunkSize);
            $chunkFilter->setRows($startRow,$chunkSize,range('A','C'));
            $objPHPExcel = $objReader->load($file_path.$file_name); 
        
            $rowIterator = $objPHPExcel->getActiveSheet()->getRowIterator();
            
            foreach($rowIterator as $row){
                $cellIterator = $row->getCellIterator();
                foreach ($cellIterator as $cell) {
                    
                    $column = $cell->getColumn();
                    $input_data = $cell->getCalculatedValue();
                    $input_data = trim($input_data);
                    
                    if($column == 'A'){
                        $data[$i]['customer_name'] = $input_data;
                    } 
                    else if($column == 'B'){
                        $custom_mobile = $input_data;
                        //check validate mobile number
                        if (!preg_match('/^84/', $custom_mobile)){
                            if (!preg_match('/^0/', $custom_mobile)){
                                $custom_mobile = "84".$custom_mobile;
                            }
                            else {
                                $custom_mobile = preg_replace('/^0/','84', $custom_mobile);
                            }
                        }
                        
                        if (preg_match('/^849(0|1|2|3|4|5|6|7|8)[0-9]{7}$/', $custom_mobile) or preg_match('/^8499(3|4|5|6)[0-9]{6}$/', $custom_mobile) or 
                            preg_match('/8412[0-9][0-9]{7}$/', $custom_mobile) or preg_match('/^8416(3|4|5|6|7|8|9)[0-9]{7}$/', $custom_mobile) or 
                            preg_match('/^84199[0-9]{7}$/', $custom_mobile)){
                                $data[$i]['customer_mobile'] = $custom_mobile;
                        }else{
                            $data[$i]['customer_mobile'] = '';
                            $invalid++; 
                        }
                        
                    } 
                    else if($column == 'C'){
                        $operator_name = $input_data;
                        //check hdh tuong ung
                        $operator_info = $this->Model->getData('operator',array('operator_name'=>$operator_name));
                        if(count($operator_info)!=0){
                            $data[$i]['operator_id'] = $operator_info[0]['operator_id'];
                        }else{
                            $data[$i]['operator_id'] = '';
                        }
                        
                        break;
                    } 
                }
                $i=$i+1;
            }
        
        }
        
        unlink($file_path.$file_name);
        //insert vao db  
        foreach($data as $rs){
            if($rs['customer_mobile']!=''){
                $rs['user_id'] = $this->session->userdata('user_id');
                $effect_row = $this->Model->insert('customers',$rs);
                if($effect_row>0){
                    $success++;
                }else{
                    $duplicate++;
                }
            }
        }
        $result = array('success'=>$success,'duplicate'=>$duplicate,'invalid'=>$invalid);       
        return $result;
    }
    
    /**
    * function download template file
    */
    public function download($filename){
        $filepath = $_SERVER['DOCUMENT_ROOT'].'/public/export/'.$filename;
        header("Content-Type: application/download: charset=utf-8");
        header("Content-Disposition: attachment; filename =".$filename );
        header("Content-Length: " . filesize($filepath));
        $fp = fopen($filepath, "r");
        fpassthru($fp);
        fclose($fp);
    }
}