@extends('admin.layouts.app')

@section('title','Dashboard')

@section('content')

@php 
$user = auth()->user();
@endphp

<h4 class="text-success mb-3">{{ strtoupper($user->role) }} DASHBOARD</h4>

<div class="dashboard-box">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <span class="badge badge-warning p-2">URLs</span>
            <strong class="ml-2">Dashboard</strong>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-dark btn-sm">Logout</button>
        </form>
    </div>

    @if($user->role === 'SuperAdmin')
        <p class="text-muted mb-3">SuperAdmin cannot invite Admins in new companies.</p>
    @endif

    @if($user->role === 'Admin')
        <form method="POST" action="{{ route('invite.send') }}" class="mb-4">
            @csrf
            <h6>Invite Sales / Manager</h6>
            <div class="form-inline">
                <input type="email" name="email" class="form-control form-control-sm mr-2" placeholder="User Email" required>
                <select name="role" class="form-control form-control-sm mr-2" required>
                    <option value="Sales">Sales</option>
                    <option value="Manager">Manager</option>
                </select>
                <button class="btn btn-warning btn-sm">Send Invite</button>
            </div>
        </form>
    @endif

    
    @if(in_array($user->role,['Sales','Manager']))
        <form method="POST" action="{{ route('shorturls.store') }}" class="mb-3">
            @csrf
            <div class="form-inline">
                <input type="url" name="original_url" class="form-control form-control-sm mr-2" placeholder="Enter Long URL" required>
                <button class="btn btn-primary btn-sm">Generate</button>
            </div>
        </form>
    @endif

   
    @if(session('success'))
        <div class="alert alert-success alert-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-sm">{{ session('error') }}</div>
    @endif

    @if($user->role !== 'SuperAdmin')
        <div class="table-responsive">
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>Short URL</th>
                        <th>Long URL</th>
                        <th>Hits</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($urls as $url)
                        <tr>
                            <td><a href="{{ url('/s/'.$url->short_code) }}">{{ url('/s/'.$url->short_code) }}</a></td>
                            <td>{{ $url->original_url }}</td>
                            <td>{{ $url->hits }}</td>
                            <td>{{ $url->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">No URLs Available</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

</div>

@endsection
