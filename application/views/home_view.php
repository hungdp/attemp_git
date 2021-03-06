<section class="admin-dashboard">
    <div class="row-fluid show-grid">
        <div class="span4">
            <div class="adminbox color-3">
                <div class="admin-shadow">
                    <span class="admin-icon"><img src="public/img/icons/icon-news.png" alt="system" /></span>
                    <div class="admin-contentlist">
                        <h2>Nội dung</h2>
                        <ol>
                            <li><a href="<?=base_url()?>customers/">Danh sách khách hàng</a></li> 
                        </ol>
                    </div>
                </div>
            </div><!--adminbox-->
        </div><!--span4-->
        <div class="span4">
            <div class="adminbox color-6">
                <div class="admin-shadow">
                    <span class="admin-icon"><img src="public/img/icons/icon-user.png" alt="system" /></span>
                    <div class="admin-contentlist">
                        <h2>Người dùng</h2>
                        <ol>
                            <li><a href="<?=base_url()?>user/">Danh sách người dùng</a></li>
                            <li><a href="<?=base_url()?>grouproles/">Quản lý phân quyền</a></li>
                            <li><a href="<?=base_url()?>group/">Nhóm người dùng</a></li>
                            <li><a href="<?=base_url()?>roles/">Danh sách quyền</a></li>
                        </ol>
                    </div>
                </div>
            </div><!--adminbox-->
        </div><!--span4-->
        <div class="span4">
            <div class="adminbox color-1">
                <div class="admin-shadow">
                    <span class="admin-icon"><img src="public/img/icons/icon-marketing.png" alt="system" /></span>
                    <div class="admin-contentlist">
                        <h2>Quản lý tin nhắn</h2>
                        <ol>
                            <li><a href="<?=base_url()?>message/template">Quản lý mẫu tin nhắn</a></li>
                            <li><a href="<?=base_url()?>message/send_message">Gửi mới tin nhắn</a></li>
                            <li><a href="<?=base_url()?>message/history">Thống kê tin nhắn</a></li>    
                        </ol>
                    </div>
                </div>
            </div><!--adminbox-->
        </div><!--span4-->
        <div class="span4">
            <div class="adminbox color-2">
                <div class="admin-shadow">
                    <span class="admin-icon"><img src="public/img/icons/icon-system.png" alt="system" /></span>
                    <div class="admin-contentlist">
                        <h2>Quản lý thiết bị</h2>
                        <ol>
                            <li><a href="<?=base_url()?>modem/show">Thông tin thiết bị</a></li>
                            <li><a href="<?=base_url()?>modem/operator">Quản lý hệ điều hành</a></li>     
                        </ol>
                    </div>
                </div>
            </div><!--adminbox-->
        </div><!--span4-->
    </div><!--row-fluid-->
</section><!--admin-dashboard-->