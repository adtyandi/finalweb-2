@extends('layouts.app')

@section('content')
<!-- Main Content -->
<div class="main-content">
<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>

    @role('admin')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>User</h4>
                    </div>
                    <div class="card-body">
                    {{ $total_pengguna }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="far fa-paper-plane"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Beli Tiket</h4>
                    </div>
                    <div class="card-body">
                    {{ $total_pengajuan }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    @role('Andi')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero bg-primary text-white">
                <div class="hero-inner">
                    <h2>Welcome Back, {{ Auth::user()->username }}!</h2>
                    <p class="lead">Web Travel Group 4</p>
                    <div class="mt-4">
                        <a href="{{ route('pengajuan-kredit.create') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-paper-plane"></i> Beli tiket sekarang!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
</section>
</div>
@endsection

@section('script')

@endsection