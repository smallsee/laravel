@extends('master')

@include('component.loading')

@section('title', '登录')

@section('content')
<label class="form-label col-3">预览图：</label>
<div class="formControls col-5">
  <img id="preview_id" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
  <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'preview_id');" />
</div>

<div class="weui_cells_title"></div>
<div class="weui_cells weui_cells_form">
  <div class="weui_cell">
      <div class="weui_cell_hd"><label class="weui_label">帐号</label></div>
      <div class="weui_cell_bd weui_cell_primary">
          <input class="weui_input" type="tel" name="username" placeholder="邮箱或手机号"/>
      </div>
  </div>
  <div class="weui_cell">
      <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
      <div class="weui_cell_bd weui_cell_primary">
          <input class="weui_input" type="tel" name="password" placeholder="不少于6位"/>
      </div>
  </div>
  <div class="weui_cell weui_vcode">
      <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
      <div class="weui_cell_bd weui_cell_primary">
          <input class="weui_input" type="text" name="validate_code" placeholder="请输入验证码"/>
      </div>
      <div class="weui_cell_ft">
          <img src="/service/validate_code/create" class="bk_validate_code"/>
      </div>
  </div>
</div>
<div class="weui_cells_tips"></div>
<div class="weui_btn_area">
  <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onLoginClick();">登录</a>
</div>
<a href="/register" class="bk_bottom_tips bk_important">没有帐号? 去注册</a>
@endsection

@section('my-js')
<script type="text/javascript">
  $('.bk_validate_code').click(function () {
    $(this).attr('src', '/service/validate_code/create?random=' + Math.random());
  });
</script>

<script>
    function onLoginClick() {
                var username = '';
                var password = '';
                var validate_code = '';

                username = $('input[name=username]').val();
                password = $('input[name=password]').val();
                validate_code = $('input[name=validate_code]').val();

                $.ajax({
                    type: "POST",
                    url: '/service/login',
                    dataType: 'json',
                    cache: false,
                    data: { username: username,password: password,
                         validate_code: validate_code, _token: "{{csrf_token()}}"},
                    success: function(data) {
                        if(data == null) {
                            $('.bk_toptips').show();
                            $('.bk_toptips span').html('服务端错误');
                            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            return;
                        }
                        if(data.status != 0) {
                            $('.bk_toptips').show();
                            $('.bk_toptips span').html(data.message);
                            setTimeout(function() {$('.bk_toptips').hide();}, 2000);
                            return;
                        }

                        $('.bk_toptips').show();
                        $('.bk_toptips span').html('登录成功');
                        setTimeout(function() {$('.bk_toptips').hide();}, 2000);

                        location.href = '{{$return_url}}';
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        console.log(status);
                        console.log(error);
                    }
                });
    }
</script>
@endsection
