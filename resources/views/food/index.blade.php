@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">

        {{--Successfully Message--}}
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show col-12 mt-3 text-center" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        {{--List of Foods--}}
        @if (count($foods))
            @foreach ($foods as $food)
                <div class="col-md-6 text-center">
                    <div class="card m-2 bg-light">
                        <div class="card-body">
                            <h5 class="card-title">{{ $food->title }}</h5>
                            <p>| {{ $food->type->title }} |</p>
                            @if($food->stock)
                                <a href="{{ route('orders.create', ['food_id' => $food->id]) }}"
                                   class="col btn btn-sm btn-primary">
                                    Order
                                </a>
                            @else
                                <a href="" class="col btn btn-sm btn-dark disabled">Finished</a>
                            @endif
                            <hr>
                            <a href="{{ route('orders.history', $food->id) }}"
                               class="btn btn-sm btn-warning">
                                History
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{--Food Not Exist Message--}}
            <div class="alert alert-info text-center col mt-3">No <strong>Food</strong> Exist.</div>
        @endif
    </div>
</div>
@endsection
