@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Сумма вклада</th>
                            <th scope="col">Процент</th>
                            <th scope="col">Количество текущих начислений</th>
                            <th scope="col"> Сумма начислений</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Дата </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($deposit))
                        <tr>
                            <th scope="row">{{ $deposit->id }}</th>
                            <td>{{ $deposit->invested }}</td>
                            <td>{{ $deposit->percent }}</td>
                            <td>{{ $deposit->accrue_times }}</td>
                            <td>{{ $deposit->invested/5 }}</td>
                            <td>{{ $deposit->active }}</td>
                             <td>{{ $deposit->created_at }}</td>
                        </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('deposit.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="deposit">Deposit</label>
                            <input type="number" class="form-control" name="deposit">
                            @if($errors->any())
                                <span class="text-danger"><h6>{{$errors->first()}}</h6></span>
                            @endif
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
