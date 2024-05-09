// Simple Tiny MCE
tinymce.init({
    selector: ".tinymce_simple",
    theme: "modern",
    height: 80,
    menubar: false,
    statusbar: false,
    plugins: [
      "autolink link image lists hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality template paste textcolor",
    ],
    valid_elements : '*[*]',
    toolbar:
      "undo redo styleselect bold italic  alignleft aligncenter alignright alignjustify bullist numlist link  preview fullpage forecolor",
  });
  // Advance Tiny MCE
tinymce.init({
  selector: ".tinymce_advance",
  image_class_list: [
    {title: 'img-responsive', value: 'img-responsive'},
    ],
    height: 500,
    setup: function (editor) {
        editor.on('init change', function () {
            editor.save();
        });
    },
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ",

    image_title: true,
    automatic_uploads: true,
    images_upload_url: '/admin/upload',
    file_picker_types: 'image',
    file_picker_callback: function(cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        input.onchange = function() {
            var file = this.files[0];

            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function () {
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);
                cb(blobInfo.blobUri(), { title: file.name });
            };
        };
        input.click();
    }
});
$(document).ready(function () {
    //Icheck
    $('input.iCheck').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
    });

    //Icheck Blue
    $('input.blueCheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });

    //Icheck Red
    $('input.iCheck_Red').iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        increaseArea: '20%' // optional
    });

    //Icheck Grey
    $('input.greyCheck').iCheck({
      checkboxClass: 'icheckbox_square-grey',
      radioClass: 'iradio_square-grey',
      increaseArea: '20%' // optional
  });

    // check all
    $('input.checkAll').on('ifToggled', function (e) {
        var target = $(this).data('target');

        if (this.checked) {
            $(target).iCheck('check');
        } else {
            $(target).iCheck('uncheck');
        }
    });
    // show / hide target
    $('[data-toggle="show"]').click(function () {
        var target = $(this).data('target');
        $(target).toggle();
    });

    // show / hide target
    $('[data-visible]').click(function () {
        var visible = $(this).data('visible');
        var target = $(this).data('target');
        if (visible == 'show') {
            $(target).show();
        } else {
            $(target).hide();
        }
    });

    // per_page

    $('select[name="per_page"]').change(function () {
      var target = $(this).data('target');
      var $form = $(target);

      $('input[name=method]', $form).val('per_page');

      $form.submit();
     });

      // ul.nav-tabs > li.active open
    if (location.hash) {
      $('[data-toggle="tab"][href="' + location.hash + '"]').trigger('click');
  }

  $('[data-toggle="tab"]').click(function () {
      location.hash = $(this).attr('href');
  });

  // chặn Enter xuống dòng ở .input-text
  $('.input-text').on('keypress', function (e) {
      if (e.which == 13) {
          e.preventDefault();
          $(this).closest('form').submit();
      }
  });

  // .btn-action
  $('a.btn-action').click(function () {
      var target = $(this).data('target');
      var $form = $(target);
      var method = $(this).data('method');
      var is_confirm = true;
      if (!confirm('Có chắc bạn muốn thao tác này?')) {
          is_confirm = false;
      }
      $('input[name=method]', $form).val(method);

      if (method == 'active') {
          $('input[name=method]', $form).val('status');
          $('input[name=status]', $form).val(1);
      } else if (method == 'inactive') {
          $('input[name=method]', $form).val('status');
          $('input[name=status]', $form).val(0);
      }
      else if (method == 'capnhat_ngay_hach_toan') {
          $form.append('<input type="hidden" name="ngay_hach_toan" value="'+ $('.history_transaction_accounting_from_date').val()+'" />');
      }
      if (is_confirm) {
          $form.submit();
      }

      return false;
  });

  // .btn-delete
  $('a.btn-delete').click(function () {
      if (confirm('Có chắc bạn muốn xóa?')) {
          var id = $(this).data('id');
          var url = $(this).data('url');
          var token = $(this).data('token');
          var data = {
              _token : token,
              method: 'delete',
              ids: [id]
          };
          $.ajax({
            url: url,
            method: 'post',
            data: data,
            success: function(data){
                location.reload();
            }
        });
      }
  });

  // .btn-status
  $('a.btn-status').click(function (e) {
      var id = $(this).data('id');
      var url = $(this).data('url');
      var status = $(this).data('status');
      var method_custom = $(this).data('method');
      var _token = $('meta[name="csrf-token"]').attr('content');
      var data = {
          _token: _token,
          method: 'status',
          method_custom : method_custom,
          status: status ? 0 : 1,
          ids: [id]
      };

      $.post(url, data, function (json) {
          if(json.success == false){
              toastr.warning(json.message);
          }
          location.reload();
      });
  });

  $('.change_status').on('click', '.onoffswitch-label', function (e) {
    var div = $(this).parents('div.onoffswitch');
    var input = div.find('input');

    var id = input.attr('data-id');
    if (input.attr('checked')) {
        var checked = 0;
    } else {
        var checked = 1;
    }
    if (!requestSend) {
        requestSend = true;
        $.ajax({
            url: input.attr('data-url'),
            type: 'put',
            data: {
                id: id,
                status: checked
            },
            success: function (response) {
                if (response.success == true) {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
                requestSend = false;
            }
        });
    } else {
        e.preventDefault();
    }
})

});
