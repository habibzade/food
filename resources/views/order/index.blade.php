@extends('layout.app')

@section('content')

<div class="row justify-content-md-center mt-5">
    <div class="col-lg-10 col-sm-12">
        <div class="col card bg-light p-3">

            {{-- Success or Error Messages --}}
            @if (Session::has('success') || Session::has('error'))
                <div class="alert alert-{{ Session::has('success') ? 'success' : 'danger' }} alert-dismissible fade show
                            text-center" role="alert">
                    <strong>{{ Session::get('success') ?? Session::get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{--List of Orders--}}
            <h5>Orders</h5>
            @if (count($orders))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->food->title }}</td>
                                <td>
                                    <div class="row">
                                        <!--Confirm-->
                                        <div class="col">
                                            <a href="{{ route('admin.orders.confirm', $order->id) }}"
                                               class="btn btn-sm btn-primary">Confirm</a>
                                        </div>
                                        <!--Delete-->
                                        <div class="col">
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                {{--Order Not Exist Message--}}
                <div class="alert alert-info text-center">No <strong>Order</strong> Exist.</div>
            @endif
        </div>
    </div>
</div>

@endsection
