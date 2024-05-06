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
                        <h4 class="text-center">Deposite Transactions List</h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                  <th scope="col">SL</th>
                                  <th scope="col">amount</th>
                                  <th scope="col">Trans Type</th>
                                </tr>
                              </thead>
                              <tbody>

                            @php
                                $subTotal = 0;
                            @endphp


                                @foreach ($deposites as $deposite)
                                  <tr>
                                    <th scope="row">{{ $loop->index + 1}}</th>
                                    <td>{{ $deposite->amount}}</td>
                                    <td>{{ $deposite->transaction_type}}</td>
                                  </tr>

                                  @php
                                  $subTotal +=$deposite->amount;
                              @endphp
                                @endforeach

                                <tr>
                                    <td>Total Amount</td>
                                    <td>{{$subTotal}}</td>
                                </tr>

                              </tbody>
                          </table>
                    </div>
                </div>

            </div>
          </div>
    </div>
  </div>
</div>

@endsection
