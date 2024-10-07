@extends('dashboard.layouts.app')
@section('content')
    <div class="container mt-5">
        @if(session()->has('error'))
            <div class="row mb-5">
                <div class="col">
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                    </div>
                </div>
            </div>
    </div>
        @endif

        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                <div class="card">
                    <div class="card-body">
                        <span>Welecom To Re-sellers Dashboard</span>
                    </div>
                </div>
            </div>
            </div>
    </div>
@endsection
