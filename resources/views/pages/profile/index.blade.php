@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
        </div>

        <div class="row">
            <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    @if (!empty(Auth::user()->photo))
                        <img alt="image" src="{{ asset('images/'.Auth::user()->photo) }}" class="rounded-circle profile-widget-picture">
                    @else
                        <img alt="image" src="{{ asset('stisla/img/avatar/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                    @endif
                </div>
                <div class="profile-widget-description">
                <div class="profile-widget-name">{{ Auth::user()->name }} /<div class="text-muted d-inline font-weight-normal">@foreach (Auth::user()->roles as $item) {{ $item->name }}
                @endforeach</div></div>
                <blockquote class="blockquote">
                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                </blockquote>
                </div>
            </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" action="{{ route('profile.update',[Auth::user()->id]) }}" enctype="multipart/form-data" class="needs-validation" novalidate="" accept-charset="utf-8">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">
                    <div class="row">              
                        @csrf
                        @method('PUT')                 
                        <div class="form-group col-12">
                        <input type="hidden" name="id" value="{{ Auth::user()->id }}" required="">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required="">
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                        <label>NIK/NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ Auth::user()->nip }}" required="">
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                        </div>
                        <div class="form-group col-md-6 col-12">
                        <label>Nama Pengguna</label>
                        <input type="text" name="username" class="form-control" value="{{ Auth::user()->username }}" required="">
                        <div class="invalid-feedback">
                            Please fill in the first name
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required="">
                        <div class="invalid-feedback">
                            Please fill in the email
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                        <label>Foto Profil</label>
                            <input type="file" name="photo" size="20" class="form-control">
                            <div class="text-muted form-text">
                            Maksimum ukuran file adalah 5 MB, dengan jenis file ".jpg" ".png"
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </section>
</div>
@endsection