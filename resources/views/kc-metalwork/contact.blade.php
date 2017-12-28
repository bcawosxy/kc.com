@extends('kc-metalwork.layout.master')

@section('content')
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="section-title">
                        <h3>Get in touch with Us</h3>
                    </div>
                    <hr style="width: 100px;">
                    <div class="col-md-6 col-sm-6">
                        <input name="name" maxlength="16" type="text" class="form-control" placeholder="*您的大名">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input name="email" maxlength="32" type="email" class="form-control" placeholder="*Email">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <input name="phone" type="text" maxlength="16" class="form-control" placeholder="連絡電話">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <select name="service" class="form-control">
                            <option>服務項目</option>
                            <option disabled>---------------</option>
                            @foreach($data['services'] as $k0 => $v0)
                                <option value="{{$v0['id']}}">{{$v0['name']}}</option>
                            @endforeach
                            <option value="other">其他</option>
                        </select>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <textarea name="content" class="form-control" rows="5" placeholder="(必填)"></textarea>
                    </div>

                    <div class="col-md-3 col-sm-4">
                        <input type="submit" id="send" class="form-control" value="送出">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('footer')
    @parent
    <script>
        function _swal(r) {
            switch (r.status) {
                case 0 : status = 'error'; break;
                case 2 : status = 'warning'; break;
                case 3 : status = 'info'; break;
                case 4 : status = 'question'; break;
                default : status = 'success'; break;
            }

            swal({
                'text' : r.message,
                'type' : status,
                'timer': 2000,
            }).then(
                function () { if(r.redirect) location.href = r.redirect; },
                function (dismiss) { if(r.redirect) location.href = r.redirect; }
            ).catch(swal.noop);
        }

        $('#send').on('click', function () {
            var name = $('input[name="name"]').val(),
                email = $('input[name="email"]').val(),
                phone = $('input[name="phone"]').val(),
                service = $('select[name="service"]').val(),
                content = $('textarea[name="content"]').val(),
                numberValid = /^\d+$/;


            if(name.length == 0 || email.length == 0 || content.length == 0) {
                if(name.length == 0) $('input[name="name"]').css('border', '1px solid red').attr('placeholder', '請輸入姓名');
                if(email.length == 0) $('input[name="email"]').css('border', '1px solid red').attr('placeholder', '請輸入Email');
                if(content.length == 0) $('textarea[name="content"]').css('border', '1px solid red').attr('placeholder', '請輸入您要連絡我們的訊息');
            } else if( phone.length >0 && !numberValid.test(phone)) {
                $('input[name="phone"]').css('border', '1px solid red').val('').attr('placeholder', '格式錯誤, 請重新輸入');
            } else {
                $.ajax({
                    url: '{{url('/contact')}}',
                    type: 'post',
                    data: {
                        value: {'name': name, 'email' : email, 'phone' : phone, 'service' : service, 'content' : content},
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function (r) {
                        _swal(r);
                    },
                    error: function (r) {
                        r = r.responseJSON;
                        _swal(r);
                    },
                });
            }
        })

    </script>
@endsection
