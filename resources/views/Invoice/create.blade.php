@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Buat Invoice</h3>
                    </div>
                    <div class = "card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">{
                            {session('error')}    
                            }
                            </div>
                        @endif
                                
                        <form action="{{route('invoice.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">customer</label>
                                <select name="customer_id" id="form-control" required>
                                    <option value="">pilih</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id}}">{{ $customer->name}} - {{ $customer->email}}</option>   
                                    @endforeach
                                </select>
                            </div>
                            <div class ="form-group">
                                    <button class="btn btn-primary btn-sm">Buat</button>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection