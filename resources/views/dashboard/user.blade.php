@extends('layouts.master')
@section('title','signup')
@section('content')

<div class='container'>
  <div class='row mt-3'>
    <div class='col-md-6 offset-md-3'>
        <div class="card">
            <div class="card-header">
                <h3>Create New User</h3>
            </div>
            <div class="card-body shadow-sm">

                @if ($errors->any())
                 <ul>
                    @foreach ($errors->all() as $error )
                     <li class="text-danger">{{ $error }}</li>
                    @endforeach
                 </ul>
                @endif

                @if (session()->has('success'))
                <p class="text-success">{{ session()->get('success')}}</p>
                @endif

                <form action="{{ route('dashboard.create.user')}}" method="post">
                    @csrf

                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" />
                      </div>

                      <div class="mb-2">
                        <label for="email" class="form-label">Account Type</label>
                        <select class="form-select" name="account_type">
                            <option selected>select</option>
                            <option value="individual">individual</option>
                            <option value="business">business</option>
                          </select>
                      </div>

                    <div class="mb-2">
                      <label for="balance" class="form-label">Balance</label>
                      <input type="number" class="form-control" name="balance" id="balance" />
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" />
                      </div>

                    <div class="mb-2">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Create User</button>
                  </form>
            </div>
          </div>
    </div>
  </div>
</div>

@endsection
