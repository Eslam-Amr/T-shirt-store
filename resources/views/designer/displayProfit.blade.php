@extends('adminlte::page')
@section('content')
<style>
    .c:hover{
transform: scale(1.1);

    }
    .c{
    transition: transform 0.5s ease; /* Adjust the duration and easing as needed */
}

</style>

<div class="container mt-5">
    <div class="col-12">
        <div class="row">

            <div  class="col-6 mt-5 ">
                    <a style="display: block" href="{{ route('designer.displayYearProfit') }}">
                    <div class="col-8 text-center p-5 bg-success c">

                        <h2>year</h2>
                        {{-- <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayProfit') }}"> Control </a></button> --}}
                    </div>
                </a>
                </div>
            <div  class="col-6 mt-5 ">
                    <a style="display: block" href="{{ route('designer.displayMonthProfit') }}">
                    <div class="col-8 text-center p-5 bg-success c">

                        <h2>month</h2>
                        {{-- <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayProfit') }}"> Control </a></button> --}}
                    </div>
                </a>
                </div>
            <div  class="col-6 mt-5 ">
                    <a style="display: block" href="{{ route('designer.displayDayProfit') }}">
                    <div class="col-8 text-center p-5 bg-success c">

                        <h2>day</h2>
                        {{-- <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayProfit') }}"> Control </a></button> --}}
                    </div>
                </a>
                </div>
            <div  class="col-6 mt-5 ">
                    {{-- <a style="display: block" href=""> --}}
                    <div class="col-8 text-center p-5 bg-success c">

                        <h2>sumtion profit : {{ $totalProfit }} EGP</h2>
                        {{-- <button class="btn btn-secondary mt-3"><a class="text-white" href="{{ route('admin.displayProfit') }}"> Control </a></button> --}}
                    </div>
                {{-- </a> --}}
                </div>

        </div>
    </div>
</div>
@endsection
