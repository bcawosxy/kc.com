@extends('admin.layout.master')

@section('content')
<section class="content-header">
    <div class="box-body"><h2>Banner橫幅圖</h2></div>
    <h1>
        <small><p class="text-light-blue"></p></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo url('admin', 'index') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Banner橫幅圖</li>
    </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-body">
            <div class="row">
                <div class="col-md-10">
                    <div class="box-body box-solid">
                        <div class="box-body">
                            <dl class="dl-horizontal">
                                <dt></dt>
                                <dd>
                                    <div class="form-group">
                                        <div class="text-muted">
                                            <h4>※&nbsp;&nbsp;單點照片可放大&nbsp;&nbsp;拖動照片改變順序</h4>
                                            <h4>圖片格式: JPG / JPEG / PNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;檔案大小: 5MB</h4>
                                            <h4>圖片尺寸: 980 * 490</h4>
                                        </div>
                                    </div>
                                </dd>
                                <br>
                                <dt>Banner燈箱:</dt>
                                <dd>
                                    <div class="form-group">
                                        <ul id="sortable">
                                            <?php
                                            if(is_array($a_image)){
                                                foreach($a_image as $k0 => $v0) {
                                                    if(is_file(PATH_FILES._SUB_CLASS.'/'.$v0)) image_reformat(PATH_FILES._SUB_CLASS.'/'.$v0, 'jpg', 150, 100);
                                                    echo '<li class="ui-state-default" data-set="old" data-filename="'.$v0.'">
																	<a href="'.URL_FILES._SUB_CLASS.'/'.$v0.'" data-gallery><img src="'.URL_FILES._SUB_CLASS.'/'.sinechat_Thumbnail($v0, 150, 100).'">
																	<a href="javascript:void(0)"> <button type="button" style="padding:0;margin-top:5px;" class="btn btn-block btn-danger box_delete">移除</button></a>
																</li>';
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                </dd>
                                <br>
                                <dt>上傳Banner:</dt>
                                <dd>
                                    <div class="form-group">
                                        <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                                            <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-12">
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn btn-success fileinput-button">
															<i class="glyphicon glyphicon-plus"></i>
															<span>選擇檔案</span>
															<input type="file" name="files[]" multiple>
														</span>
                                                    <button type="submit" class="btn btn-primary start">
                                                        <i class="glyphicon glyphicon-upload"></i>
                                                        <span>上傳全部</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning cancel">
                                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                                        <span>取消全部</span>
                                                    </button>
                                                    <button type="button" class="btn btn-danger delete">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                        <span>刪除全部</span>
                                                    </button>
                                                    <input type="checkbox" class="toggle">
                                                    <span class="fileupload-process"></span>
                                                </div>
                                            </div>
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-12 fileupload-progress fade">
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                    </div>
                                                    <div class="progress-extended">&nbsp;</div>
                                                </div>
                                            </div>
                                            <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                            <div class="row">
                                                <div class="col-lg-12">
														<span class="btn bg-purple margin" id="put-in-box">
															<i class="fa fa-inbox"></i>
															<span>放入燈箱</span>
														</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </dd>
                                <br>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<a class="btn btn-app" href="<?php echo url('admin', 'setbanner') ?>">
    <i class="fa fa-angle-double-left"></i> 上一頁
</a>
<a class="btn btn-app" id="save">
    <i class="fa fa-save"></i> 儲存(Save)
</a>
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
@endsection

@section('footer')
    @parent
<script>
    function save() {
        var img_item = [];
        $('#sortable li').each(function(k ,v) {
            var tmp =  {'sequnce' : k, 'set' : $(this).data('set'), 'filename' : $(this).data('filename')}
            img_item.push(tmp);
        });

        var processingBox = new jBox('Modal', {
            closeOnClick: false,
            closeButton: 'title',
            width: 140,
            height: 50,
            onOpen : function(){
                $.post('<?php echo url('admin', 'setbanner/index') ?>' , {
                    image : JSON.stringify(img_item),
                },function(r){
                    r = $.parseJSON(r);
                    processingBox.close();
                    if(r.result == 1) {
                        $('button._auto').each(function() {
                            $(this).trigger('click');
                        });
                        _jbox(r, 'success');
                    }else{
                        _jbox(r, 'error');
                    }
                });
            },
        }).setContent('<span style="padding-left:20px;font-weight:bold;color:rgba(85, 85, 85, 0.8);">處理中...</span><img src="<?php echo URL_IMG.'loading.gif'?>">').open();

    }

    $(document).on('click', '.box_delete',function(){
        $(this).parents('li').remove();
    });

    $(function () {
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });

        $('#save').on('click', function(){
            var img_unput = $('tr.unput').length, img_un_upload  = $('tr.un_upload ').length;
            if(img_unput > 0 || img_un_upload > 0) {
                check = false;
                var Confirm_box = new jBox('Confirm', {
                    cancelButton: '否',
                    confirmButton: '是',
                    title : '<span style="display: inline-block;height: 100%;vertical-align: middle;"><i style="color:#3C8DBC;font-size:2em ;" class="fa fa-info-circle"></span>',
                    confirm: function() {
                        save();
                    },
                    cancel : function(){},
                    onCloseComplete: function() {
                        Confirm_box.destroy();
                    }
                }).setContent(
                    '<div class="jbox_div">' +
                    '<p>您有未上傳或未置入燈箱的圖片,繼續儲存動作將會刪除這些圖片,您要儲存嗎?</p>' +
                    '</div>'
                ).open();
            }else{
                save();
            };
        });

        'use strict';
        $('#fileupload').fileupload({
            url: '<?php echo url('admin', 'setbanner/fileupload') ?>',
        });
        $('#fileupload').fileupload(
            'option',
            'redirect',
            window.location.href.replace(
                /\/[^\/]*$/,
                '/cors/result.html?%s'
            )
        );
        $('#fileupload').addClass('fileupload-processing');

        $.ajax({
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0],
        }).always(function () {
            $(this).removeClass('fileupload-processing');
        }).done(function (result) {
            $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
        }).success(function(result, textStatus, jqXHR) {

        });

        $( "#sortable" ).sortable({
            start: function( event, ui ) {},
            stop: function( event, ui ) {},
        });
        $( "#sortable" ).disableSelection();

        $('#put-in-box').on('click' ,function() {
            var _download = $('tbody.files tr.unput');
            if(_download.length == 0) {
                var r = {'message': '沒有可放入燈箱的圖片 !'};
                _jbox(r, 'error');
            }else {
                _download.each(function(k, v) {
                    var obj = $(v).find('span.preview a');
                    var item = '<li class="ui-state-default" data-set="new" data-filename="'+obj.attr('download')+'">' +
                        '<a href="'+obj.attr('href')+'" data-gallery><img src="'+obj.attr('href')+'"></a>' +
                        '<a href="javascript:void(0)"> <button type="button" style="padding:0;margin-top:5px;" class="btn btn-block btn-danger box_delete">移除</button></a>' ;
                    '</li>';
                    $('#sortable').append(item);
                    $(v).removeClass('unput').addClass('settled').find('td.delete_btn').children().hide();
                    $(v).removeClass('unput').find('td.delete_btn').append('<i class="fa fa-check-square-o"></i>');
                });
            }
        });
    });

</script>

<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="un_upload template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>上傳</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel _auto">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="unput template-download fade ">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td class="delete_btn">
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete _auto" data-type="{%=file.deleteType%}" data-url="<?php echo url('admin', 'setbanner/fileupload', ['file'=>'']) ?>{%=file.name%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>刪除</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel _auto">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>取消</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
@endsection
