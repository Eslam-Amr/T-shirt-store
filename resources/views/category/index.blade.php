@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb',['name' => 'Shop Category'])
<form action="">
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li>
                                        <a href="{{ route('category.index','all') }}">all
                                            <span>({{$numberOfProducts['menProduct']+$numberOfProducts['kidsProduct']+$numberOfProducts['womenProduct']}})</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('category.index','men') }}">men
                                            <span>({{$numberOfProducts['menProduct']}})</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('category.index','women') }}">women

                                            <span>({{$numberOfProducts['womenProduct']}})</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('category.index','kids') }}">Kids

                                            <span>({{$numberOfProducts['kidsProduct']}})</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets p_filter_widgets price_rangs_aside">
                            <div class="l_w_title">
                                <h3>Price Filter</h3>
                            </div>
                            <div class="widgets_inner">
                                <div class="range_item">
                                    <!-- <div id="slider-range"></div> -->
                                    <input type="text" class="js-range-slider" value="" />
                                    <div class="d-flex">
                                        <div class="price_text">
                                            <p>Price :</p>
                                        </div>
                                        <div class="price_value d-flex justify-content-center">
                                            <input type="text" class="js-input-from" id="amount" readonly />
                                            <span>to</span>
                                            <input type="text" class="js-input-to" id="amount" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    <p><span>{{$numberOfProducts['menProduct']+$numberOfProducts['kidsProduct']+$numberOfProducts['womenProduct']}} </span> Prodict Found</p>
                                </div>
                                <div class="single_product_menu d-flex">
                                    <h5>short by : </h5>
                                    <select>
                                        <option data-display="Select">name</option>
                                        <option value="1">price</option>
                                        <option value="2">product</option>
                                    </select>
                                </div>                     
                                <div class="single_product_menu d-flex">
                                    <div class="input-group">
                                        <input type="text" id="search" class="form-control" placeholder="search"
                                            aria-describedby="inputGroupPrepend">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i
                                                    class="ti-search"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                    <div class="row align-items-center latest_product_inner">
                            @foreach ($products as $product)
                            <div class="col-lg-4 col-sm-6">
                                <div class="single_product_item">
                                    <a href="{{ route('home.productDetails',$product->id) }}">
                                        <img class="product__img w-100 h-100 object-fit-cover"
                                        src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                        data-id="white">
                                    </a>
                                    <div class="single_product_text">
                                        <h4>{{$product['name']}}</h4>
                                        <h3>{{$product['price_after_discount']}} EGP</h3>
                                        <a href="{{route('home.addToCart', $product['id'] )}}" class="add_cart">+ add to cart<i class="ti-heart"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        <div class="col-lg-12">
                            <div class="pageination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-center">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <i class="ti-angle-double-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <i class="ti-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Category Product Area =================-->

    <!-- product_list part end-->
@include('layout.footer')
  