@extends('layouts.app')
@section('content')
   <div class="row">
       <div class="col-md-10 offset-1">
           <div class="card">
               <div class="card-body">
                   <form action="{{ route('deposit.store') }}" method="POST">
                       @csrf
                       <div class="form-group">
                           <label for="deposit">Deposit</label>
                           <input type="number" class="form-control" name="deposit">
                       </div>
                       <div class="form-group">
                           <button type="submit" class="btn btn-primary">Create+</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
@endsection
