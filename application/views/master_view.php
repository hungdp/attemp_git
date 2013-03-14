<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php if(isset($title)) echo $title;?></title>
    <base href="<?=base_url()?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="Shortcut Icon" href="http://appota.com/images/appota.ico" type="image/x-icon">
    <!-- styles -->
    <link href="<?=base_url()?>public/css/bootstrap.css" rel="stylesheet" />
    <link href="<?=base_url()?>public/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?=base_url()?>public/css/content.css" rel="stylesheet" />
    <link href="<?=base_url()?>public/css/private_style.css" rel="stylesheet" />
    <script src="<?=base_url()?>public/js/jquery.js"></script>
    <script src="<?=base_url()?>public/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/js/jquery.validate.unobtrusive.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/js/jquery.validate.bootstrap.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/js/common.js" type="text/javascript"></script>
    <script src="<?=base_url()?>public/js/private_function.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $("form").validate();
        });
    </script>
</head>
<body>
<header>
    <div class="container">
        <a class="logo" href="<?=base_url()?>"><img src="public/img/logo.png" alt="APPOTA" /></a>
        <div class="menu pull-right">
            <a href="<?=base_url()?>">Trang chủ</a>
        <?php if(isset($userName)){
            echo  '| <a href="'.base_url().'login/logout">Đăng xuất</a>';
            echo '(<span style="color:#d9251d;">'.$userName.'</span>)';
        }?>
        </div>
    </div><!--container-->
</header><!--header-->
<?php if(isset($userName)){?>
<div class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Nội dung<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url()?>customers/">Danh sách khách hàng</a></li> 
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Người dùng<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url()?>user/">Danh sách người dùng</a></li>
                            <li><a href="<?=base_url()?>grouproles/">Quản lý phân quyền</a></li>
                            <li><a href="<?=base_url()?>group/">Nhóm người dùng</a></li>
                            <li><a href="<?=base_url()?>roles/">Danh sách quyền</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Quản lý tin nhắn<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url();?>message/template">Quản lý mẫu tin</a></li>
                            <li><a href="<?=base_url();?>message/send_message">Gửi mới tin nhắn</a></li>
                            <li><a href="<?=base_url();?>message/history">Thống kê tin nhắn</a></li>  
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Quản lý thiết bị<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=base_url();?>modem/show">Thông tin thiết bị</a></li>
                            <li><a href="<?=base_url();?>modem/operator">Quản lý hệ điều hành</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div><!--navbar-->
    <?php
}
?>
<div class="container">
    <?php
    $this->load->view($content);
    ?>
    <hr />
    <footer>
        <p>&copy; APPOTA <?php echo date("Y");?></p>
    </footer>
</div> <!--container-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=base_url()?>public/js/bootstrap.js"></script>    
<script src="public/js/jquery.ui.core.js"></script>
<script src="public/js/jquery.ui.datepicker.js"></script>
<script src="public/js/jquery.ui.datepicker-vi.js"></script>
<script src="public/js/datepicker.js"></script>
</body>
</html>
