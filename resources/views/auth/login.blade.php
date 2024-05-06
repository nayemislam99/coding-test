@extends('layouts.master')
@section('title','login')
@section('content')

<div class='container'>
  <div class='row mt-5'>
    <div class='col-md-6 offset-md-3'>
        <div class="card">
            <div class="card-body shadow-sm">
                <form action="{{ route('auth.login')}}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid  @enderror" id="email" />

                      @error('email')
                      <strong class="text-danger">{{ $message}}</strong>
                      @enderror
                    </div>

                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid  @enderror" id="password">
                      @error('password')
                      <strong class="text-danger">{{ $message}}</strong>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                  </form>
            </div>
          </div>
    </div>
  </div>
</div>

@endsection
