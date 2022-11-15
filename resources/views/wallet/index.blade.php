@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $wallet->balance }}</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('wallet.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="deposit">Wallet</label>
                            <input type="number" class="form-control" name="wallet">

                            @if($errors->any())
                                <span class="text-danger"><h6>{{$errors->first()}}</h6></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">ADD+</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
