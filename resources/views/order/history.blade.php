@extends('layout.app')

@section('content')

<div class="row justify-content-md-center mt-5">
    <div class="col-lg-10 col-sm-12">
        <div class="col card bg-light p-3">
            
            {{--List of Orders--}}
            @if (count($orders))
                <div class="text-center"><h6>History</h6></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Food Title</th>
                            <th>Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->food->title }}</td>
                                <td class="text-secondary">{{ $order->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            @else
                {{--order(s) Not Exist Message--}}
                <div class="alert alert-info text-center">No <strong>History</strong> Exist.</div>
            @endif

            {{--order Types Management--}}
            <a class='btn btn-sm btn-outline-dark mb-3' href="{{ route('home') }}">
                <strong>Back to List</strong>
            </a>

        </div>
    </div>
</div>

@endsection
