@extends('adminlte::page')
@section('content')
    <form action="{{ route('admin.updateUser', $user->id) }}" method="post">
        @csrf
        {{-- @method('PUT') --}}
        <div class="container p-5">
            <div class="row">
                <h1 class="col-12 text-success text-bold text-center">EDIT</h1>
                <div class="col-12">
                    <label for="name">name</label>
                    <input type="text" id="name" class="form-control my-3" name="name" value="{{ $user->name }} "
                    placeholder="name">
                </div>

                @error('first_name')
                {{ $message }}
                @enderror
                <div class="col-12">

                    <label for="email">email</label>
                    <input type="text" class="form-control my-3" name="email" value="{{ $user->email }} "
                    placeholder="email">
                </div>
                @error('email')
                {{ $message }}
                @enderror
                <div class="col-12">

                    <label for="phone">phone</label>
                    <input type="text" class="form-control my-3" name="phone" value="{{ $user->phone }} "
                        placeholder="phone">
                </div>
                @error('phone')
                    {{ $message }}
                @enderror



                <input type="submit" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection
