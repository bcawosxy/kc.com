@extends('kc-metalwork.layout.master')

@section('content')

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="section-title">
                        <h3>About Us</h3>
                    </div>
                    {!! $data['value'] !!}
                </div>
            </div>
        </div>
    </section>

@endsection

