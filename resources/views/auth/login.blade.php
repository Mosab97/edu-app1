@extends('layouts.container')
@section('style')
@endsection

@php
    $breadcrumb = false;
    $title = w('Login');
@endphp



@section('content')
    {{--    @php--}}
    {{--        $showcase = Setting('showcase_background');--}}
    {{--            $bre = isset($showcase)?asset_public(Setting('showcase_background')):asset_site('images/background/1.jpg');--}}
    {{--    @endphp--}}
    <section class="full-height relative no-top no-bottom vertical-center"
             data-bgimage="url('{{asset_public(optional(Setting('showcase_background'))[lang()])}}') top"
             data-stellar-background-ratio=".5">
        <div class="overlay-gradient t50">
            <div class="center-y relative">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-5 text-light wow fadeInRight" data-wow-delay=".5s">
                            <div class="spacer-10"></div>
                            <div class="h1 text-light"><br>
                                @php
                                    $showcase_title = optional(setting('showcase_title'))[lang()];
                                    $showcase_details = optional(setting('showcase_details'))[lang()];
                                @endphp
                                <div class="typed-strings">
                                    <p>{{$showcase_title}}</p>
                                    <p>{{$showcase_title}}</p>
                                    <p>{{$showcase_title}}</p>
                                    <p>{{$showcase_title}}</p>
                                </div>
                                <div class="typed"></div>
                            </div>
                            <p class="lead">{{$showcase_details}}</p>
                            <div class="spacer-20"></div>
                            <a class="btnC" style="color:#4C9F85" href="javascript:;"> <b>{{w('Free consultation')}}</b></a>&nbsp;
                            <div class="mb-sm-30"></div>
                        </div>

                        <div class="col-lg-4 offset-lg-2 wow fadeIn" data-wow-delay=".5s">
                            <div class="box-rounded padding40" data-bgcolor="#ffffff">
                                <h3 class="mb10">Sign In</h3>
                                <p>{{w('Login using an existing account or create a new account')}} <a
                                        href="{{url('/register')}}">{{w('here')}}<span></span></a>.</p>
                                <form name="contactForm" id='contact_form' class="form-border" method="post"
                                      action='{{route('login')}}'>
                                    @csrf
                                    <div class="field-set">
                                        <input type='text' name='email' id='email' class="form-control"
                                               placeholder="{{w('Username')}}">
                                    </div>

                                    <div class="field-set">
                                        <input type='password' name='password' id='password' class="form-control"
                                               placeholder="{{w('Password')}}">
                                    </div>

                                    <div class="field-set">
                                        <input type='submit' id='' value='{{w('Login')}}'
                                               class="btn btn-custom btn-fullwidth color-2">
                                    </div>

                                    <div class="clearfix"></div>

                                    <div class="spacer-single"></div>

                                    <!-- social icons -->
                                    <ul class="list s3">
                                        <li>{{w('Login with:')}}</li>
                                        <li><a href="{{url('/login/linkedin')}}">{{w('LinkedIn ')}}</a></li>
                                        <li><a href="{{route('login.google')}}">{{w('Google')}}</a></li>
                                    </ul>
                                    <!-- social icons close -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
@endsection


