@extends('admin.layouts.app')

@section('content')
<div class="app app-default">
    {{-- Sidebar goes here --}}
    @include('admin.layouts.sidebar')

    {{-- Header goes here --}}
    @include('admin.layouts.header')

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <a href="{{url('admin/user')}}" class="card card-banner card-aliceblue-light">
                <div class="card-body">
                    <i class="icon fa fa-users fa-4x"></i>
                    <div class="content">
                        <div class="title">Users</div>
                        <div class="value"><span class="sign"></span>{{$user_count}} </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
    {{-- Footer goes here --}}
    <!-- @include('admin.layouts.footer') -->
@endsection
