@extends('admin.layout.master')

@section('content')
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
            min-height: 200px;
        }
        #sortable>li {
            float:left;
            padding:1px;
            width:150px;
            height:100px;
            font-size:0.5em;
            text-align:center;
            margin: 3px 3px 40px 0;
        }
    </style>
<div class="content-wrapper" style="height: auto;">
    <section class="content-header">
        <div class="box-body"><h2>Banner橫幅圖</h2></div>
        <ol class="breadcrumb">
            <li><a href="{{ url()->route('admin::index')  }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Banner橫幅圖</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-body">
                <div style="height: auto">
                    <div id="alert_w" class="callout callout-warning">
                        <p>拖曳圖片改變順序</p>
                        <p>圖片格式: JPG / JPEG / PNG&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;檔案大小: 5MB</p>
                        <p>圖片尺寸: 980 * 490</p>
                    </div>
                </div>
                <div class="row">
                    <dl class="dl-horizontal">
                        <dt>上傳:</dt>
                        <dd>
                            <div class="form-group" style="width:98%;">
                                <!-- The fileinput-button span is used to style the file input field as button -->
                                <span class="btn btn-success fileinput-button">
                                        <i class="glyphicon glyphicon-plus"></i>
                                        <span>Select files...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                                        <input id="fileupload" type="file" name="files[]" multiple>
                                    </span>
                                <br><br>
                                <!-- The global progress bar -->
                                <div id="progress" class="progress">
                                    <div class="progress-bar progress-bar-success"></div>
                                </div>
                            </div>
                        </dd>
                        <br>
                        <dt>Banner:</dt>
                        <dd>
                            <div class="form-group">
                                <ul id="sortable">
                                    <?php
                                        foreach ($data['banners'] as $k0 => $v0) {
                                            echo ' <li class="ui-state-default ui-sortable-handle" data-set="old" data-filename="'.$v0['name'].'">
                                                <a href="javascript:void(0)">
                                                    <img style="width:100%" src="'.$v0['url'].'">
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <button type="button" style="padding:0;margin-top:5px;" class="btn btn-block btn-danger box_delete">移除</button>
                                                </a>
                                            </li>';
                                        }
                                    ?>
                                </ul>
                            </div>
                        </dd>
                        <br>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    <a class="btn btn-app" href="{{url()->route('admin::banner')}}">
        <i class="fa fa-angle-double-left"></i> 上一頁
    </a>
    <a class="btn btn-app" id="save">
        <i class="fa fa-save"></i> 儲存(Save)
    </a>

</div>
@endsection

@section('footer')
    @parent
    <script>
        'use strict';
        var target = '<?php echo URL('upload/files'); ?>/', item;

        $('#fileupload').fileupload({
            url: "{{ url()->route('admin::fileUpload')  }}",
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if( file.error ) {
                        _swal({'status': 0, 'message': file.error});
                        $('#progress .progress-bar').css('width', '0%');
                    } else {
                         item = `<li class="ui-state-default ui-sortable-handle" data-set="new" data-filename="${file.name}">
                                <a href="javascript:void(0)" data-gallery="">
                                    <img style="width:100%" src="${target  + file.name}">
                                </a>
                                <a href="javascript:void(0)">
                                    <button type="button" style="padding:0;margin-top:5px;" class="btn btn-block btn-danger box_delete">移除</button>
                                </a>
                            </li>`;
                       $('#sortable').append(item);

                       setTimeout(function(){
                           $('#progress .progress-bar').css('width', '0%');
                       }, 1000);
                    }
                });
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css('width', progress + '%');
            }
        }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

        $('#save').on('click', function(){
            var images = [];
            $('#sortable li').each(function(k ,v) {
                var tmp =  {'sequnce' : k, 'set' : $(this).data('set'), 'filename' : $(this).data('filename')}
                images.push(tmp);
            });

            if(images.length == 0 ) {
                var r = {'status' : 3, 'message' : 'bad'};
                _swal(r);
            }
            else {
                $.ajax('<?php echo url()->route('admin::bannerupdate') ?>', {
                    type : 'post',
                    data: {
                        images : images ,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (r) {
                        _swal(r);
                    },
                    error : function (r) {
                        r = r.responseJSON;
                        _swal(r);
                    },

                });
            }
        });

        $(document).on('click', '.box_delete',function(){
            $(this).parents('li').remove();
        });

        $( "#sortable" ).sortable({
            start: function( event, ui ) {},
            stop: function( event, ui ) {},
        });

        $( "#sortable" ).disableSelection();
    </script>

@endsection