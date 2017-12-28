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
                    <form action="#" method="post">
                        <div class="col-md-6 col-sm-6">
                            <input name="name" type="text" class="form-control" placeholder="您的大名">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input name="email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <input name="phone" type="telephone" class="form-control" placeholder="連絡電話">
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
                            <textarea name="content" class="form-control" rows="5" placeholder="..."></textarea>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <input type="submit" class="form-control" value="送出">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('footer')
    @parent
    <script>

    </script>
@endsection
