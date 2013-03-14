<?php
/**
 * User: hungdp
 * Date: 3/6/13
 * Time: 5:44 PM
 */
class Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Function get one column from table
     * @param $table
     * @param $id
     * @param $var
     * @return mixed
     */
    function get_one($table, $id, $var)
    {
        return $this->db->query("select * from $table where $id='$var'");
    }

    /**
     * Function delete one row from table
     * @param $table
     * @param $idname
     * @param $id
     * @return mixed
     */
    function delete($table, $idname, $id)
    {
        $this->db->query("Delete from $table where $idname = $id");
        return $this->db->affected_rows();
    }

    /**
     * Function update data
     * @param $id_name
     * @param $id
     * @param $table
     * @param $data
     * @return mixed
     */
    function update($id_name, $id, $table, $data)
    {
        $this->db->where($id_name, $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Function insert
     * @param $table
     * @param $data
     * @return mixed
     */
    function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Function get data
     * @param $table
     * @param null $data
     * @param null $orderby
     * @param null $start
     * @param null $nums
     * @param null $desc
     * @param null $exp
     * @return mixed
     */
    function get_data($table, $data = NULL, $orderby = NULL, $start = NULL, $nums = NULL, $desc = NULL, $exp = NULL)
    {
        $where = '';
        if ($exp == null) $exp = '=';
        if ($data != null) {
            $where = ' where ';
            $i = 0;
            foreach ($data as $key => $value) {
                $where .= $key . $exp . "'" . $value . "'";
                $i++;
                if ($i < count($data)) {
                    $where .= " and ";
                }
            }
        }
        if ($start != null and $nums != null) {
            $limit = " limit ";
            $limit .= $start . "," . $nums;
        } else {
            $limit = "";
        }
        if ($desc == null) {
            $desc = ' asc ';
        }
        if ($orderby != null) {
            $result = $this->db->query("select * from {$table}  {$where} order by {$orderby} $desc " . $limit);
        } else {
            $result = $this->db->query("select * from {$table}  {$where} " . $limit);
        }

        return $result;
    }
    
    //function get data with condition
    public function getData($table,$item=FALSE){
        if($item!=FALSE){
            $this->db->where($item);
        }
        $query = $this->db->get($table);
        return $query->result_array();
    }
    //get data with in array condition
    public function get_where_in($table,$key,$in_array){
        $this->db->where_in($key,$in_array);
        $query = $this->db->get($table);
        return $query->result_array();   
    }
    
    //function get data for search proccess
    public function get_data_search($action,$limit=FALSE,$start_from=FALSE){
        
        $this->db->where('sms.user_id',$this->session->userdata('user_id'));
        
        //check xem co lay thong so dien thoai ko
        
        /*if($this->session->userdata('number')!=''){
            $this->db->like('receivers',$this->session->userdata('number')); 
            //echo "1|";
        }*/
        
        //check xem co lay  thong trang thai tin nhan ko
        if($this->session->userdata('status')!=''){
            $this->db->where('status',$this->session->userdata('status'));
            //echo "2|";
        }
        
        //check xem co lay theo noi dung hay ko
        if($this->session->userdata('message')!=''){
            $this->db->like('message',$this->session->userdata('message'));
            //echo "3|";
        }
        
        //check theo thoi gian gui tu ngay
        if($this->session->userdata('from_date')!=''&&$this->session->userdata('end_date')==''){
            //echo "4|";
            $from =  $this->display_lib->timeDatabase($this->session->userdata('from_date'));
            $sql = "(DATEDIFF(create_time,'".$from."')>=0)";    
            $this->db->where($sql);
        }else if($this->session->userdata('from_date')==''&&$this->session->userdata('end_date')!=''){ //lay den ngay
            //echo "5|";
            $end =  $this->display_lib->timeDatabase($this->session->userdata('end_date'));
            $sql = "(DATEDIFF(create_time,'".$end."')<=0)";
            $this->db->where($sql);
        }else if($this->session->userdata('from_date')!=''&&$this->session->userdata('end_date')!=''){   //lay trong khoang
            //echo "6|";
            $from =  $this->display_lib->timeDatabase($this->session->userdata('from_date'));
            $end =  $this->display_lib->timeDatabase($this->session->userdata('end_date'));
            $sql = "(DATEDIFF(create_time,'".$from."')>=0 AND DATEDIFF(create_time,'".$end."')<=0)";
            $this->db->where($sql);
        }
        //lay tu bang sms
        $this->db->from('sms');
        
        //update join voi bang sms_receiver de lay so dien thoai nguoi nhan
        $this->db->join('sms_receiver','sms.sms_id=sms_receiver.sms_id');
        if($this->session->userdata('number')!=''){
            $number = preg_replace('/^0/',84,$this->session->userdata('number'));
            $this->db->like('sms_receiver.receiver',$number); 
            //echo "1|";
        }
        
        //check xem co lay theo he dieu hanh ko 
        if($this->session->userdata('operator')!=''){
            //echo "7|";
            $this->db->where('operator_id',$this->session->userdata('operator'));
            $this->db->join('customers','sms_receiver.receiver=customers.customer_mobile');   
        }

        //end update
        //neu dem tong so ban ghi
        if($action=='count'){
            $query = $this->db->count_all_results();
        }else if($action=='sum'){
            $this->db->select_sum('sms.message_length');
            $query = $this->db->get();
            $query->result_array();
            $query = $query->result_array();
            if(count($query)!=0){
                return $query[0]['message_length'];
            }else{
                return 0;
            }
        }else{ //lay ban ghi tu vi tri start from;
            if(isset($limit)&&isset($start_from)){
                $this->db->limit($limit,$start_from);
            }
            $query = $this->db->get();
            $query = $query->result_array();
        }
        
        return $query;
    }
    
    /**
     * Function delete all data in table
     * @param $table
     */
    function deleteAll($table){
        $this->db->empty_table(''.$table.'');
    }
    
    /**
    * function insert and return id of effected row
    */
    function insertData($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }
    
    /**
    * insert batch data
    */
    public function insert_batch($table,$data){
        $this->db->insert_batch($table,$data);
        return $this->db->affected_rows();  
    }
    
    /**
    * update status when expired time
    */
    public function update_expire(){
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $this->db->where('status',2);
        $sql = "(DATEDIFF(now(),create_time)>1)";
        $this->db->where($sql);
        $this->db->update('sms',array('status'=>0));
    }
    
    /**
    * get sms status =2
    */
    public function get_update_status(){
        $this->db->select('sms_id');
        $this->db->where('status',2);
        $this->db->where('user_id',$this->session->userdata('user_id'));
        $query = $this->db->get('sms');
        return $query->result_array();
    }
}

?>