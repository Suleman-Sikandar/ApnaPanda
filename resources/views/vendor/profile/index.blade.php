@extends('vendor.layouts.master')

@section('title', 'Vendor Profile | ApnaPanda')

@section('content')
    <div class="profile-container">
        <div class="container">
            <div class="profile-layout">
                @include('vendor.includes.sidebar')

                <main class="profile-content">
                    @if($activeSection == 'profile')
                        @include('vendor.profile.personal')
                    @elseif($activeSection == 'business')
                        @include('vendor.profile.business')
                    @elseif($activeSection == 'documents')
                        @include('vendor.profile.documents')
                    @elseif($activeSection == 'bank')
                        @include('vendor.profile.bank')
                    @elseif($activeSection == 'addresses')
                        @include('vendor.profile.address')
                    @elseif($activeSection == 'face_verification')
                        @include('vendor.profile.face_verification')
                    @elseif($activeSection == 'security')
                        @include('vendor.profile.security')
                    @endif
                </main>
            </div>
        </div>
    </div>
@endsection
