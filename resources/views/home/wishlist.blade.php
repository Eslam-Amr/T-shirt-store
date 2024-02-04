@include('layout.header')
<style>
      .input-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .input-container span {
            margin: 0 10px;
        }

        .input-field {
            background-color: rgba(0, 0, 0, 0.15);
            width: 70px;
            text-align: center;
        }

        #amount {
            width: 300px;
        }
</style>
@include('layout.navbar')
@include('layout.breadcrumb',['name' => 'wishlist'])
{{-- <form action="{{ route('category.filter',['key' => 'all', 'from' => 0, 'to' => 500]) }}"> --}}
<form action="{{ route('category.index') }}">
    <section class="cat_product_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="left_sidebar_area">
                        <aside class="left_widgets p_filter_widgets">
                            <div class="l_w_title">
                                  {{-- <div class="price-range-slider">
                                    <input type="range" id="min-price" min="0" max="500" value="100">
                                    <input type="range" id="max-price" min="0" max="500" value="400">
                                    <span>Min: <span id="min-price-value">100</span></span>
                                    <span>Max: <span id="max-price-value">400</span></span>
                                  </div> --}}
                                <h3>Browse Categories</h3>
                            </div>
                            <div class="widgets_inner">
                                <ul class="list">
                                    <li>
                                        <label for="all">all
                                            <span>
                                            ({{ $numberOfProducts['menProduct']+
                                            $numberOfProducts['womenProduct']+
                                            $numberOfProducts['kidsProduct'] }})
                                            </span>
                                        </label>
                                        {{-- <input type="checkbox" {{ $key=='all'? 'checked' :''  }}    name="all" value="all" id="all"> --}}
                                        <input type="checkbox"  {{ isset($data['all'])? 'checked' :''  }}   name="all" value="all" id="all">
                                    </li>
                                    <li>
                                        <label for="men">men
                                            <span>({{$numberOfProducts['menProduct']}})</span>
                                        </label>
                                            {{-- <input type="checkbox" {{ $key[0]=='m'? 'checked' :''  }}   name="men" value="men" id="men"> --}}
                                            <input type="checkbox"  {{ isset($data['men'])? 'checked' :''  }}  name="men" value="men" id="men">
                                    </li>
                                    <li>
                                        <label for="women">women

                                            <span>({{$numberOfProducts['womenProduct']}})</span>
                                        </label>
                                        {{-- <input type="checkbox"  {{ $key[0]=='w'? 'checked' :''  }}  name="women" value="women" id="women"> --}}
                                        <input type="checkbox" {{ isset($data['women'])? 'checked' :''  }}   name="women" value="women" id="women">
                                    </li>
                                    <li>
                                        <label for="kids">Kids

                                            <span>({{$numberOfProducts['kidsProduct']}})</span>
                                        </label>
                                        {{-- <input type="checkbox" {{ $key[0]=='k'? 'checked' :''  }}   name="kids" value="kids" id="kids"> --}}
                                        <input type="checkbox" {{ isset($data['kids'])? 'checked' :''  }}   name="kids" value="kids" id="kids">
                                    </li>

                                </ul>
                            </div>
                        </aside>
                        <aside class="left_widgets p_filter_widgets price_rangs_aside">
                            <div class="l_w_title">
                                <h3>Price Filter</h3>
                            </div>
                            {{-- @dd(isset($data['from'])) --}}
                            {{-- <input type="number"  style="background-color: rgba(0, 0, 0, 0.15);width: 300px" class=" form-control" name="from" id="amount"  /> --}}
                                {{-- <div class=" d-flex justify-content-center">
                                    <span>from</span>
                                    <input type="number" style="background-color: rgba(0, 0, 0, 0.15);width: 70px" value="{{ isset($data['to'])? $data['to'] :'0' }} " name="from" class="form-control">
                                    <span>to</span>
                                    <input type="number" style="background-color: rgba(0, 0, 0, 0.15);width: 70px" value="{{ isset($data['to'])? $data['to'] :'0'  }}" class="js-input-to form-control" id="amount" name="to"  />
                              </div> --}}
                              {{-- @dd($data) --}}
                              <div class="input-container">
                                <span>From</span>
                                <input type="number" class="input-field form-control" name="from" value="{{ isset($data['from']) ? $data['from'] : 0  }}">
                                <span>To</span>
                                <input type="number" class="input-field form-control" name="to" value="{{ isset($data['to']) ? $data['to'] : 500  }}">
                            </div>
                        
                            <div class="widgets_inner">
                                {{-- <div class="range_item">
                                    <input type="text" class="js-range-slider"  />
                                    <div class="d-flex">
                                        <div class="price_text">
                                            <p>Price :</p>
                                        </div> 
                                        <div class="price_value d-flex justify-content-center">
                                            <input type="text" class="js-input-from"  name="from" id="amount"  />
                                            <span>to</span>
                                            <input type="text" class="js-input-to" id="amount"  name="to"  />
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- <div id="slider-range"></div> -->
                                {{-- <input type="text" class="js-input-from"  name="from" id="amount" value="{{ $from }}" /> --}}
                                {{-- <input type="text" class="js-input-to" id="amount"  name="to" value="{{ $to }}" /> --}}
                                 {{-- <div class="price-range-slider">
                                    <input type="range" id="min-price" min="0" max="500" value="100">
                                    <input type="range" id="max-price" min="0" max="500" value="400">
                                    <span>Min: <span id="min-price-value">100</span></span>
                                    <span>Max: <span id="max-price-value">400</span></span>
                                  </div>  --}}
                                  <input type="submit" class="btn btn-danger" value="filter">
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product_top_bar d-flex justify-content-between align-items-center">
                                <div class="single_product_menu">
                                    {{-- <p><span>{{$totalNoOfProduct}} </span> Prodict Found</p> --}}
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
                                            {{-- {{ $products->links() }} --}}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
       const minPriceSlider = document.getElementById('min-price');
const maxPriceSlider = document.getElementById('max-price');
const minPriceValue = document.getElementById('min-price-value');
const maxPriceValue = document.getElementById('max-price-value');

minPriceSlider.addEventListener('input', () => {
  const minValue = minPriceSlider.value;
  maxPriceSlider.value = Math.max(minValue, maxPriceSlider.value); // Ensure max >= min
  minPriceValue.textContent = minValue;
  // Update slider styling (optional)
});

    </script>
@include('layout.footer')