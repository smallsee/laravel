<form action="" method="post" class="form form-horizontal" id="form-category-add">
  {{ csrf_field() }}
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>名称：</label>
    <div class="formControls col-5">
      <input type="text" class="input-text" value="" placeholder="" name="name" datatype="*" nullmsg="名称不能为空">
    </div>
    <div class="col-4"> </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3"><span class="c-red">*</span>序号：</label>
    <div class="formControls col-5">
      <input type="number" class="input-text" value="0" placeholder="" name="category_no"  datatype="*" nullmsg="序号不能为空">
    </div>
    <div class="col-4"> </div>
  </div>
  <div class="row cl">
    <label class="form-label col-3">预览图：</label>
    <div class="formControls col-5">
      <img id="preview_id" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
      <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'preview_id');" />
    </div>
  </div>
  <div class="row cl">
    <div class="col-9 col-offset-3">
      <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
    </div>
  </div>

  <textarea name="baidu" id="baidueditor" cols="30" rows="10"></textarea>

  <button onclick="uploadBaidu()">上传</button>







</form>

<button onclick="qqLogin()">QQ登录</button>

<script src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/admin/js/uploadFile.js"></script>
<script type="text/javascript" src="/admin/lib/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="/admin/lib/kindeditor/kindeditor.js"></script>

<script>

  function qqLogin(){
    location.href = '/qqlogin'
  }


  function uploadBaidu(){
    var parent_id= $('#baidueditor').val();

    console.log('parent_id:    ' + parent_id);

    $.ajax({
      type: "POST",
      url: '/data',
      dataType: 'json',
      cache: false,
      data: { parent_id: parent_id, _token: "{{csrf_token()}}"},
      success: function(data) {
        console.log('获取类别数据');
        console.log(data);
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

      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });


  }





  $("#form-category-add").Validform({
    tiptype:2,
  })

  KindEditor.ready(function(K){
    window.editor = K.create('#baidueditor',{
      uploadJson : '/baidu',
      afterBlur : function(){this.sync();}, //
    })
  })

</script>
