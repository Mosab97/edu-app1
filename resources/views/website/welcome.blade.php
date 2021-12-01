@extends('layouts.container')
@section('style')
@endsection
@section('content')

    <section aria-label="section"
             data-bgimage="url('{{asset_public(optional(Setting('showcase_background'))[lang()])}}') top"
             class="text-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 wow fadeInRight" data-wow-delay=".5s">
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
                    <p class="lead">{!!$showcase_details!!}</p>
                    <div class="spacer-20"></div>
                    <a class="btnC" style="color:#4C9F85" href="https://calendly.com/injaz-sa/15min"
                       target="_blank"><b>{{w('Free consultation')}}</b></a>&nbsp;
                    <div class="mb-sm-30"></div>
                </div>

                <div class="col-lg-6 offset-lg-1 text-center wow fadeInLeft" data-wow-delay=".5s">
                    <img src="{{asset_public(Setting('showcase_background_front'))}}" class="img-fluid" alt=""/>
                </div>
            </div>
        </div>
    </section>
    <section id="section-highlight" data-bgcolor="#f0f4fd">
        <div class="container">

            <div class="text-center">
                {{--                <span class="p-title">Discover</span><br>--}}
                <h2>{{w('Advantages')}}</h2>
                <div class="small-border"></div>
            </div>

            <div class="row sequence">
                @foreach($advantages as $index=>$item)
                    <div class="col-lg-4 col-md-6 mb30 sq-item wow">
                        <div class="f-box f-icon-left f-icon-circle f-icon-shadow">
                            <img src="{{$item->image}}" alt="image" style="
                                height: 100px;
                                width: 100px;
                                margin: {{lang() == 'ar'? '0 0 0 13px' : '0 13px 0 0'}};
                                ">
                            <div class="fb-text">
                                <h4>{{$item->title}}</h4>
                                <p>{!!$item->details!!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
    <!-- section begin -->
    <section data-bgcolor="#f0f4fd">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    {{--                    <span class="p-title">Select</span><br>--}}
                    <h2>{{w('Packages')}}</h2>
                    <div class="small-border"></div>
                    {{--                    <div class="switch-set">--}}
                    {{--                        <div>Monthly</div>--}}
                    {{--                        <div><input id="sw-1" class="switch" type="checkbox"/></div>--}}
                    {{--                        <div>Yearly</div>--}}
                    {{--                        <div class="spacer-20"></div>--}}
                    {{--                    </div>--}}

                </div>
            </div>

            <div class="row sequence">
                @foreach($packages as $index=>$package)
                    <div class="col-lg-4 col-md-6 col-sm-12 sq-item wow">
                        <div class="pricing-s1 mb30">
                            <div class="top">
                                <h2>{{$package->name}}</h2>
                                {{--                                <p class="plan-tagline">Basic</p>--}}
                            </div>
                            <div class="mid text-light bg-color">
{{--                                <p class="price">--}}
{{--                                    <span--}}
{{--                                        class="currency">{{\App\Models\Setting::getCurrency(setting('currency'))[lang()]}}</span>--}}
{{--                                    <span class="m opt-1">{{$package->price}}</span>--}}
{{--                                    --}}{{--                                    <span class="y opt-2">0</span>--}}
{{--                                    --}}{{--                                    <span class="month">p/mo</span>--}}
{{--                                </p>--}}
                            </div>

                            <div class="bottom">

                                <ul>
                                    @foreach(optional($package)->values as $index2=>$value)
                                        <li><i class="fa fa-check"></i>{{optional($value)->value}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="action">

                                <form id="package-form-{{$package->id}}"
                                      action="{{ route('payment.package.beforePayment',$package->id) }}"
                                      {{--                                      action="{{ route('payment.package.paypal',$package->id) }}" --}}
                                      method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>

                                <a class="btn-custom" href="javascript:;" onclick="event.preventDefault();
                                    document.getElementById('package-form-' + {{$package->id}}).submit();"> {{w('Sign Up Now')}}</a>

                                {{--                                                                <a href="javascript:;" >{{w('Sign Up Now')}}</a>--}}
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--                <div class="col-lg-6 offset-lg-3 text-center">--}}
                {{--                    <small>Price shown are in USD and VAT inclusive.</small>--}}
                {{--                </div>--}}
            </div>

            <div class="spacer-double"></div>


            <div class="row">

                <div class="col-md-12 text-center">
                    <h2>{{w('FAQ')}}</h2>
                    <div class="small-border"></div>
                </div>
                @foreach($faq as $index=>$item)
                    <div class="col-md-6">
                        <!-- Accordion -->
                        <div id="accordion-{{$loop->iteration}}" class="accordion">
                            @foreach($item as $faq_index=>$faq_item)

                                <div class="card">
                                    <div id="heading-a{{($index + 1)}}" class="card-header bg-white shadow-sm border-0">
                                        <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse"
                                                                             data-target="#collapse-a{{($faq_index + 1)}}"
                                                                             aria-expanded="false"
                                                                             aria-controls="collapse-a{{($faq_index + 1)}}"
                                                                             class="d-block position-relative collapsed text-dark collapsible-link py-2">{{$faq_item->key}}</a>
                                        </h6>
                                    </div>
                                    <div id="collapse-a{{($faq_index + 1)}}"
                                         aria-labelledby="heading-a{{($faq_index + 1)}}"
                                         data-parent="#accordion-{{($index + 1)}}"
                                         class="collapse">
                                        <div class="card-body p-4">
                                            <p class="m-0">{!!$faq_item->value!!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                @endforeach
                <div class="col-12 mt-5" style="text-align: center">
                    <a href="{{route('all_faq')}}" class="btn btn-success">{{w('Show More')}}</a>
                </div>

                {{--                <div class="col-md-6">--}}
                {{--                    <!-- Accordion -->--}}
                {{--                    <div id="accordion-2" class="accordion">--}}
                {{--                        <!-- Accordion item 1 -->--}}
                {{--                        <div class="card">--}}
                {{--                            <div id="heading-b1" class="card-header bg-white shadow-sm border-0">--}}
                {{--                                <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse"--}}
                {{--                                                                     data-target="#collapse-b1" aria-expanded="false"--}}
                {{--                                                                     aria-controls="collapse-b1"--}}
                {{--                                                                     class="d-block position-relative text-dark collapsible-link py-2">Does--}}
                {{--                                        it have in-app purchases?</a></h6>--}}
                {{--                            </div>--}}
                {{--                            <div id="collapse-b1" aria-labelledby="heading-b1" data-parent="#accordion-2"--}}
                {{--                                 class="collapse">--}}
                {{--                                <div class="card-body p-4">--}}
                {{--                                    <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus--}}
                {{--                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard--}}
                {{--                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon--}}
                {{--                                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
                {{--                                        shoreditch et.</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <!-- Accordion item 2 -->--}}
                {{--                        <div class="card">--}}
                {{--                            <div id="heading-b2" class="card-header bg-white shadow-sm border-0">--}}
                {{--                                <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse"--}}
                {{--                                                                     data-target="#collapse-b2" aria-expanded="false"--}}
                {{--                                                                     aria-controls="collapse-b2"--}}
                {{--                                                                     class="d-block position-relative collapsed text-dark collapsible-link py-2">Can--}}
                {{--                                        I use this app on multiple devices?</a></h6>--}}
                {{--                            </div>--}}
                {{--                            <div id="collapse-b2" aria-labelledby="heading-b2" data-parent="#accordion-2"--}}
                {{--                                 class="collapse">--}}
                {{--                                <div class="card-body p-4">--}}
                {{--                                    <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus--}}
                {{--                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard--}}
                {{--                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon--}}
                {{--                                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
                {{--                                        shoreditch et.</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                        <!-- Accordion item 3 -->--}}
                {{--                        <div class="card">--}}
                {{--                            <div id="heading-b3" class="card-header bg-white shadow-sm border-0">--}}
                {{--                                <h6 class="mb-0 font-weight-bold"><a href="#" data-toggle="collapse"--}}
                {{--                                                                     data-target="#collapse-b3" aria-expanded="false"--}}
                {{--                                                                     aria-controls="collapse-b3"--}}
                {{--                                                                     class="d-block position-relative collapsed text-dark collapsible-link py-2">Is--}}
                {{--                                        my phone supported for this app?</a></h6>--}}
                {{--                            </div>--}}
                {{--                            <div id="collapse-b3" aria-labelledby="heading-b3" data-parent="#accordion-2"--}}
                {{--                                 class="collapse">--}}
                {{--                                <div class="card-body p-4">--}}
                {{--                                    <p class="m-0">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus--}}
                {{--                                        terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard--}}
                {{--                                        dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon--}}
                {{--                                        tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda--}}
                {{--                                        shoreditch et.</p>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}

                {{--                    </div>--}}
                {{--                </div>--}}

            </div>

        </div>
    </section>
    <!-- section close -->
    <section id="section-testimonial">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        {{--                        <span class="p-title">Latest</span><br>--}}
                        <h2>{{w('Customer Reviews')}}</h2>
                        <div class="small-border"></div>
                    </div>
                    <div class="owl-carousel owl-theme wow fadeInUp" id="testimonial-carousel">
                        @foreach($customerReviews as $index=>$item)
                            <div class="item">
                                <div class="de_testi opt-2 review">
                                    <blockquote>
                                        <div class="p-rating">
                                            @for($i = 1; $i <= $item->rate; $i++)
                                                @if($i == $item->rate)
                                                    <i class="fa fa-star"></i>
                                                @else
                                                    <i class="fa fa-star checked"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <h3>{{$item->title}}</h3>
                                        <p>{!!$item->details!!}</p>
                                        <div class="de_testi_by"><span>{{$item->customer_name}}</span></div>
                                    </blockquote>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-fun-facts" class="pt60 pb60 text-light bg-color">
        <div class="container">
            <div class="row">
                @php
                    $delay = [0,0.25,0.5,0.75,1];
                @endphp
                @foreach($statistics as $index=>$statistic)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{$delay[$index]}}s">
                        <div class="de_count">
                            <h3><span class="timer" data-to="{{$statistic->value}}"
                                      data-speed="3000">{{$statistic->value}}</span>+</h3>
                            <h5>{{$statistic->key}}</h5>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection


@section('script')
@endsection


