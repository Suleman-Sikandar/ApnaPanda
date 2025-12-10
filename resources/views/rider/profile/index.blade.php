@extends('rider.master')

@section('title', 'Rider Onboarding | ApnaPanda')

@section('content')
    <div class="profile-container">
        <div class="container">
            <div class="profile-layout">
                @include('rider.profile.sidebar')

                <main class="profile-content">
                    @if($activeSection == 'profile')
                        @include('rider.profile.personal')
                    @elseif($activeSection == 'vehicle')
                        @include('rider.profile.vehicle')
                    @elseif($activeSection == 'documents')
                        @include('rider.profile.documents')
                    @elseif($activeSection == 'address')
                        @include('rider.profile.address')
                    @elseif($activeSection == 'face_verification')
                        @include('rider.profile.face_verification')
                    @elseif($activeSection == 'security')
                        @include('rider.profile.security')
                    @endif
                </main>
            </div>
        </div>
    </div>
@endsection

