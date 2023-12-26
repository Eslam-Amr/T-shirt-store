@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="col-12">
            <div class="row">
                {{-- <div class="col-6 mt-5">
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
                            <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayUser') }}"> Control </a></button>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>designer</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayDesigner') }}"> Control </a></button>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>designer request</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayDesignerRequest') }}"> Control </a></button>
                        </div>
                </div>
                <div class="col-6 mt-5 ">
                        <div class="col-8 text-center p-5 bg-dark">

                            <h2>show design request</h2>
                            <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayDesignsRequest') }}"> Control </a></button>
                        </div>
                </div>

            </div>
        </div>
    </div>
@endsection
