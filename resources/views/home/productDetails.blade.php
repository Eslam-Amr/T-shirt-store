@include('layout.header')
@include('layout.navbar')
@include('layout.breadcrumb', ['name' => 'Shop Single'])

<div class="product_image_area section_padding">
    <div class="container">
        <div class="row s_product_inner justify-content-between">
            <div class="col-lg-7 col-xl-7">
                <div class="product_slider_img">
                    @if (session()->has('message'))
                        <div class="alert alert-danger" id="alert">

                            {{ session()->get('message') }}
                        </div>
                        <script type="text/javascript">
                            document.ready(setTimeout(function() {
                                document.getElementById('alert').remove()
                            }, 3000))
                        </script>
                    @endif
                    <div id="vertical">
                        <div data-thumb="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                            data-id="white">
                            <img src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                data-id="white">
                        </div>
                        <div data-thumb="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                            data-id="white">
                            <img src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                data-id="white">
                        </div>
                        <div data-thumb="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                            data-id="white">
                            <img src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                data-id="white">
                        </div>
                        <div data-thumb="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                            data-id="white">
                            <img src="{{ $product->image[0] == 'h' ? $product->image : asset('uplode') . '/RequestDesign/' . $product->image }}"
                                data-id="white">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4">
                <div class="s_product_text">
                    <h3>{{ $product['name'] }}</h3>
                    <h2 style="text-decoration: line-through;">{{ $product['price'] }}EGP</h2>
                    <h2>{{ $product['price_after_discount'] }}EGP</h2>
                    <ul class="list">
                        <li>
                            <a class="active" href="#">
                                <span>Category</span> : {{ $product['category'] }}</a>
                        </li>
                        <li>
                            <a href="#"> <span>Availibility</span> : {{ $product['status'] }}</a>
                        </li>
                    </ul>
                    <form action="{{ route('home.addToCart', $product['id']) }}">

                        <div class="card_area d-flex justify-content-between align-items-center">
                            <div class="product_count">
                                <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                <input class="input-number" name="quantity" type="text" value="1" min="0"
                                    max="10">
                                <span class="number-increment"> <i class="ti-plus"></i></span>
                            </div>
                            <input type="submit" class="btn_3" value="add to cart">
                    </form>
                    @if ($wishlist)
                        <a href="{{ route('wishlist.remove', $product['id']) }}" class="like_us"> <i style="color: red"
                                class="fa-solid  fa-heart"></i> </a>
                    @else
                        <a href="{{ route('wishlist.add', $product['id']) }}" class="like_us"> <i class="ti-heart"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Comments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <p>{{ $product['description'] }}</p>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="comment_list">
                            @foreach ($comments as $comment)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="img/product/single-product/review-1.png" alt="" />
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ $comment['name'] }}</h4>
                                            <h5>{{ $comment['created_at'] }}</h5>
                                        </div>
                                    </div>
                                    <p>
                                        {{ $comment['message'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Post a comment</h4>
                            <form class="row contact_form" id=""
                                action="{{ route('home.addComment', $product['id']) }}">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Your Full name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="number"
                                            placeholder="Phone Number" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn_3">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="row total_rate">
                            <div class="col-6">
                                <div class="box_total">
                                    <h5>Overall</h5>
                                    <h4>{{ $starReviews['avgStar'] }}</h4>
                                    <h6>({{ $starReviews['totalStar'] }} Reviews)</h6>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Based on {{ $starReviews['totalStar'] }} Reviews</h3>
                                    <ul class="list">
                                        <li>
                                            <a href="#">5 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> {{ $starReviews['fiveStar'] }}</a>
                                        </li>
                                        <li>
                                            <a href="#">4 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> {{ $starReviews['fourStar'] }}</a>
                                        </li>
                                        <li>
                                            <a href="#">3 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> {{ $starReviews['threeStar'] }}</a>
                                        </li>
                                        <li>
                                            <a href="#">2 Star
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i> {{ $starReviews['twoStar'] }}</a>
                                        </li>
                                        <li>
                                            <a href="#">1 Star
                                                <i class="fa fa-star"></i> {{ $starReviews['oneStar'] }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            @foreach ($reviews as $review)
                                <div class="review_item">
                                    <div class="media">
                                        <div class="d-flex">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{ $review['name'] }}</h4>
                                            @for ($i = 0; $i < $review->stars; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                    </div>
                                    <p>
                                        {{ $review['review'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="review_box">
                            <h4>Add a Review</h4>
                            <form class="row contact_form" action="{{ route('home.addReview', $product['id']) }}"
                                method="post" novalidate="novalidate">
                                @csrf
                                <p>Your Rating: &nbsp; </p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stars"
                                        id="inlineCheckbox1" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">1</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stars"
                                        id="inlineCheckbox2" value="2">
                                    <label class="form-check-label" for="inlineCheckbox2">2</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stars"
                                        id="inlineCheckbox3" value="3">
                                    <label class="form-check-label" for="inlineCheckbox3">3</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stars"
                                        id="inlineCheckbox4" value="4">
                                    <label class="form-check-label" for="inlineCheckbox4">4</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="stars"
                                        id="inlineCheckbox5" value="5">
                                    <label class="form-check-label" for="inlineCheckbox5">5</label>
                                </div>
                                <p>Outstanding</p>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Your Full name" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Email Address" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="number"
                                            placeholder="Phone Number" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="message" rows="1" placeholder="Review"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" value="submit" class="btn_3">
                                        Submit Now
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layout.footer')
