@extends('adminlte::page')

@section('content')
<style>
           .message-container {
            position: relative;
            /* display: inline-block; */
        }

        .message-icon {
            margin: 0;
        }

        .message-badge {
            position: absolute;
            top: 0;
            right: 19%;
            background-color: #e74c3c; /* Red color */
            color: #fff;
            border-radius: 50%;
            padding: 5px 8px;
            font-size: 12px;
        }
</style>
@if ($bestSeller)

<div class="col-12 pt-2">
    <div class="col-12 text-center p-5 bg-success">
        <h2>congratulations you are best seller 🎉🎉 keep going</h2>
    </div>
</div>
@endif
    <div class="container pt-2">
        <div class="col-12">
            <div class="row">

                {{-- {{ auth()->user() }} --}}
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add design</h2>
                    <a class="text-white btn btn-secondary mt-3" href="{{ route('designer.addDesign') }}"> Control </a>
                    </div>
                </div>
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">
                        <div class="message-container">
                            <h2 class="message-icon">Message</h2>
                            <div class="message-badge">{{ $numberOfMessage }}</div>
                        </div>
                    <a class="text-white btn btn-secondary mt-3" href="{{ route('designer.message') }}"> Control </a>
                    </div>
                </div>
                <div class="col-6 mt-5 ">
                    <div class="col-8 text-center p-5 bg-dark">

                        <h2>order</h2>
                        <a class="text-white btn btn-secondary mt-3" href="{{ route('designer.displayOrder') }}"> Control </a>
                    </div>
            </div>
            <div class="col-6 mt-5 ">
                <div class="col-8 text-center p-5 bg-dark">

                    <h2>profit</h2>
                    <a class="text-white btn btn-secondary mt-3" href="{{ route('designer.displayProfit') }}"> Control </a>
                </div>
        </div>
            <div class="col-6 mt-5 ">
                <div class="col-8 text-center p-5 bg-dark">

                    <h2>product</h2>
                    <a class="text-white btn btn-secondary mt-3" href="{{ route('designer.displayProduct') }}"> Control </a>
                </div>
        </div>
                {{-- <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>order</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.diplayOrder') }}"> Control </a></button>
                    </div>
                </div>
                --}}
                {{-- <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add banner</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.addBanner') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add slider</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.addSlider') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>branch</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.Branch') }}"> Control </a></button>
                        </div>
                </div> --}}
                {{-- <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>user</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayUser') }}"> Control </a></button>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>designer</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayDesigner') }}"> Control </a></button>
                        </div>
                </div> --}}

            </div>
        </div>
    </div>
@endsection
