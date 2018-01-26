@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <label for="bank">Banco</label>

                        <select name="bank" class="form form-control">

                            @foreach($banks as $bank)
                                <option value="{!! $bank->bankCode !!}">{!! $bank->bankName !!}</option>
                            @endforeach
                        </select>

                        <label for="type">Tipo de persona</label>
                        <select name="type" class="form form-control">
                            <option value="0">Persona</option>
                            <option value="1">Empresas</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
