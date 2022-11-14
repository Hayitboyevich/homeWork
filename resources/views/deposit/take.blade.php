@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="form-group">
                            <label for="deposit">Take Deposit</label>
                            <input type="number" class="form-control" name="deposit">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Take</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
