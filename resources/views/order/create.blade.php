@extends('layout.app')

@section('content')

<div class="row justify-content-md-center mt-5">
    <div class="col-lg-6 col-sm-12">
        <div class="col card bg-light p-3">

            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="food_id" value="{{ $food->id }}">

                {{--Title--}}
                <div class="form-group">
                    <label for="type">Title</label>
                    <label class="form-control">{{ $food->title }}</label>
                </div>

                {{--Type--}}
                <div class="form-group">
                    <label for="value">Type</label>
                    <label class="form-control">{{ $food->type->title }}</label>
                </div>

                {{--Time to Ready--}}
                <div class="form-group">
                    <label for="value">Time to Ready</label>
                    <label class="form-control">{{ $time_to_ready }} Minutes</label>
                </div>

                {{--Create--}}
                <div class="form-group">
                    <input type="submit" name="submit" value='Order' class='col btn btn-success'>
                </div>

                {{--Back--}}
                <div class="form-group">
                    <a class='btn btn-outline-danger col' href="{{ route('home') }}">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
