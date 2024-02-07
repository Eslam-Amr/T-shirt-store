@extends('adminlte::page')

@section('content')
<div class="container t-5">
    <div class="col-12">
        <div class="row">
            {{-- <div class="col-6 mt-5">
                @dd(auth('admin')->user())
                    @dd(        Auth::guard("admin")->user())
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add Book</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.addBook') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>order</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.diplayOrder') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add banner</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.addBanner') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5">
                    <div class="col-8 text-center p-5 bg-dark">

                    <h2>add slider</h2>
                    <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.addSlider') }}"> Control </a></button>
                    </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>branch</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.Branch') }}"> Control </a></button>
                        </div>
                </div> --}}
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>user</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayUser') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>designer</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayDesigner') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>designer request(portfolio)</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayDesignerRequest') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>product</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayProduct') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>show design request(design)</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayDesignsRequest') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>orders</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayOrder') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>contact</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayContact') }}"> Control </a>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>completed orders</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayCompletedOrder') }}"> Control </a>
                        </div>
                </div>
                <div class="col-12 mt-5 ">
                        <div class="col-10 text-center p-5 bg-dark">

                            <h2>profit</h2>
                            <a class="text-white btn btn-secondary mt-3" href="{{ route('admin.displayProfit') }}"> Control </a>
                        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
