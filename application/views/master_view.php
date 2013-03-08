<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Admin - Dashboard</title>
    <base href="<?=base_url()?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- styles -->
    <link href="public/css/bootstrap.css" rel="stylesheet" />
    <link href="public/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="public/css/content.css" rel="stylesheet" />
    <link href="<?=base_url();?>public/css/private_style.css" rel="stylesheet" />
    <script type="text/javascript" src="<?=base_url();?>public/js/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url();?>public/js/private_function.js"></script>
</head>
<body>
<header>
    <div class="container">
        <a class="logo" href="#"><img src="public/img/appota_logo.png" alt="APPOTA" /></a>
        <div class="menu pull-right">
            <a href="#">APPOTA</a>
            |
            <a href="#">Đăng xuất</a>
            (<span style="color:#d9251d;">ps.hailt</span>)
        </div>
    </div><!--container-->
</header><!--header-->
<div class="navbar navbar-inverse navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Sản phẩm<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Sản phẩm</a></li>
                            <li><a href="#">Danh mục</a></li>
                            <li><a href="#">Thương hiệu</a></li>
                            <li><a href="#">Nhà cung cấp</a></li>
                            <li><a href="#">Cam kết bán hàng</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Tin tức<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Tin tức</a></li>
                            <li><a href="#">Danh mục tin tức</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Marketing<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Banner</a></li>
                            <li><a href="#">Trang khuyến mại</a></li>
                            <li><a href="#">Coupon</a></li>
                            <li><a href="#">Giảm giá</a></li>
                            <li><a href="#">Quà tặng</a></li>
                            <li><a href="#">Landing khuyến mại</a></li>
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
                            <li><a href="#">Thông tin thiết bị</a></li>
                            <li><a href="<?=base_url();?>modem/operator">Quản lý hệ điều hành</a></li>
                        </ul>
                    </li>
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Hệ thống<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Quản lý file upload</a></li>
                            <li><a href="#">Xóa cache hệ thống</a></li>
                            <li><a href="#">Map danh mục</a></li>
                            <li><a href="#">Danh sách người bán</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </div>
</div><!--navbar-->
<div class="container">
    <?php
    $this->load->view($content);
    ?>
    <hr />
    <footer>
        <p>&copy; APPOTA 2013</p>
    </footer>
</div> <!--container-->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.js"></script>
<script src="public/js/jquery.ui.core.js"></script>
<script src="public/js/jquery.ui.datepicker.js"></script>
<script src="public/js/jquery.ui.datepicker-vi.js"></script>
<script src="public/js/datepicker.js"></script>
</body>
</html>
