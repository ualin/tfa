@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Code') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Soon you will receive a code SMS pentru solicitarea initiata. Te rugam compara primele 2 caractere cu cele afisate pe ecran si introdu ultimele 6 caractere in campul de mai jos!') }}
                    <form class="d-inline" method="POST" action="{{ route('otp.verify') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="code" id="" class="form-control" placeholder="Enter the code..">
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('Verify') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
