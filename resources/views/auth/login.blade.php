@extends('layout.app')

@section('content')
<div class="row justify-content-md-center mt-1">
    <div class="col-lg-6 col-sm-12">

        {{--Logo--}}
        <div class="text-center">
            <img src="{{ asset('img/logo.png') }}">
        </div>

        <div class="col card bg-light p-3">
            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                {{--Username--}}
                <div class="form-group">
                    <label for="username">
                        Username <span class="text-danger">*</span>
                    </label>
                    <input type="text" id="username" value="{{ old('username') }}" name="username" required
                           class="form-control">
                </div>

                {{--Password--}}
                <div class="form-group">
                    <label for="password">
                        Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>

                {{--Login--}}
                <div class="form-group">
                    <input type="submit" name="submit" value='Login' class='col btn btn-primary'>
                </div>

                {{--Register--}}
                <div class="form-group">
                    <a href="{{ route('register.show') }}" class='col btn btn-outline-primary'>Register</a>
                </div>

            </form>

            {{--Error Messages--}}
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
