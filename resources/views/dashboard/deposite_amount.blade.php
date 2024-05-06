@extends('layouts.master')
@section('title','dashboard')
@section('content')

<div class='container'>
  <div class='row mt-2'>
    <div class='col-md-12'>
        <div class="card">
            <div class="card-body shadow-sm">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav flex-column nav-pills">
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href=" {{ route('dashboard.index')}}">All Transactions</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link nav-pills" href=" {{ route('dashboard.deposite.trans')}}">Deposite Transaction</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link nav-pills" aria-current="page" href=" {{ route('dashboard.withdrawl.trans')}}">Withdrawal Transaction</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link nav-pills" aria-current="page" href=" {{ route('dashboard.deposite.amount.index')}}">Deposite Amount</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link nav-pills" aria-current="page" href=" {{ route('dashboard.withdrawl.amount.index')}}">Withdrawl Amount</a>
                              </li>
                          </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <h3>Add Deposite Amount</h3>
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

                                <form action="{{ route('dashboard.deposite.amount')}}" method="post">
                                    @csrf

                                    <div class="mb-2">
                                        <label for="deposite_amount" class="form-label">Deposite Amount</label>
                                        <input type="text" name="deposite_amount" class="form-control" id="deposite_amount" />
                                      </div>

                                    <button type="submit" class="btn btn-primary">Deposite</button>
                                  </form>
                            </div>
                          </div>
                    </div>
                </div>

            </div>
          </div>
    </div>
  </div>
</div>

@endsection
