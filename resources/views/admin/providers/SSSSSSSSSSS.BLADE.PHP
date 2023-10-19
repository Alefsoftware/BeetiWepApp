@extends('admin.layouts.main')

@section('content')
@include('admin.includes.messages')

<div class="container">
    <h1 class="mb-4">{{ __('Customer Details') }}</h1>

    <div class="card mb-4">
      <div class="card-header">
        <h4 class="card-title mb-0">{{ __('Customer Information') }}</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <p><strong>{{ __('Customer Name') }}:</strong> {{ $row->name }}</p>
            <p><strong>{{ __('Customer Mobile') }}:</strong> {{ $row->mobile }}</p>
          </div>
          <div class="col-md-4">
            <p><strong>{{ __('wallet') }}:</strong> {{$row->wallet }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h4 class="card-title mb-0">{{ __('Orders') }}</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>{{ __('provider') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('phone') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Show') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($row->orders as $index=> $r)
                <tr>
                  <td>{{ $index+1}}</td>
                  <td>{{ @$r->provider->name }}</td>
                  <td>{{ @$r->provider->name }}</td>
                  <td>{{ @$r->provider->mobile }}</td>
                  <td>{{@$r->created_at}}</td>
                  <td>{{@$r->status->title}}</td>
                  <td>{{@$r->total_amount}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a href="{{url('administration/orders/view',$r->id)}}" target="_blank"><i class="icofont-eye text-success"></i></a>
                    </div>
                </td>
                </tr>
              @endforeach
            </tbody>

          </table>
        </div>
      </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
          <h4 class="card-title mb-0">{{ __('Wallet') }}</h4>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-5">
                {{-- @php
                $prepare_time=0;
                     foreach ($row->orderProducts as $item)
                        {
                            $prepare_time += $item->product->prepare_time;
                        }
                @endphp --}}
              <p><strong>{{ __('Customer Wallet') }}:</strong> {{ $row->wallet}}</p>
              <form action='{{route('wallet.update',$row->id)}}' method='post'>
                @csrf
              <div class="input-group">
                <div class="input-group-prepend">
                  <button class="btn btn-outline-secondary" type="button" onclick="decrement()">-</button>
                </div>
                <input type="number" name='wallet' id="counter" class="form-control" value="{{$row->wallet}}" min="0" >
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="button" onclick="increment()">+</button>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
              </div>

            </form>
              <script>
                function increment() {
                  let counter = document.getElementById('counter');
                //   if (counter.value < 10) {
                    counter.value++;
                //   }
                }
                function decrement() {
                  let counter = document.getElementById('counter');
                  if (counter.value > 0) {
                    counter.value--;
                  }
                }
              </script>
            </div>
          </div>
        </div>
    </div>
</div>
@stop
