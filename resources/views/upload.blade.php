
<label class="form-label col-3">预览图：</label>
<div class="formControls col-5">
  <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  <img id="preview_id" src="/admin/images/icon-add.png" style="border: 1px solid #B8B9B9; width: 100px; height: 100px;" onclick="$('#input_id').click()" />
  <input type="file" name="file" id="input_id" style="display: none;" onchange="return uploadImageToServer('input_id','images', 'preview_id');" />
</div>

<script src="/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/admin/js/uploadFile.js"></script>
