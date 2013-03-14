<?php
/**
 * User: hungdp
 * Date: 3/12/13
 * Time: 10:20 AM
 */
class Paginate{

    var $pagination;
    function get_html($current_page,$num_record,$num_display)
    {
        $this->pagination=new CI_Pagination();
        /*$current_page : trang hien tai
        $num_record : tong so ban ghi
        $num_display : so ban ghi tren 1 trang
        */
        $config['uri_segment'] = 2;
        $config['base_url'] = $current_page;
        $config['total_rows'] = $num_record;
        $config['per_page'] = $num_display;
        // ul
        $config['full_tag_open'] = '<ul class="nav">';
        $config['full_tag_close'] = '</ul>';
        //tag of num  = li
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        //tag of current link
        $config['cur_tag_open'] = '<li class="active"><a> ';
        $config['cur_tag_close'] = '</a></li>';
        //first link
        $config['first_link'] = 'Đầu';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        //Ten cua last link
        $config['last_link'] = 'Cuối';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        //next
        $config['next_link'] = 'Tiếp';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        //prev
        //next
        $config['prev_link'] = 'Trước';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }
}
