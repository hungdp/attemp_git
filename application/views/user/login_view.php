<div class="form-signin">
    <form action="<?=base_url('login/checkLogin')?>" method="post">
        <h3 class="form-signin-heading">Đăng nhập</h3>
        <input name="username" type="text" class="input-block-level" placeholder="Tài khoản" />
        <input name="password" type="password" class="input-block-level" placeholder="Mật khẩu" />
        <label class="checkbox">
            <input type="checkbox" value="remember-me"> Nhớ mật khẩu
        </label>
        <button class="btn btn-primary" type="submit">Đăng nhập</button>
    </form>
</div><!--form-signin-->