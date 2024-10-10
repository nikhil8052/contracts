@extends('admin_layout.master')
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            @if(isset($users) && $users->isNotEmpty())
                <div class="container">
                    <div class="header-container d-flex justify-content-between col-lg-12 p-2">
                        <div class="title-container p-2">
                            <h2 class="mb-4">All Users</h2>
                        </div>
                        <div class="button-container p-2">
                            <a href="{{ url('admin-dashboard/edit-user') }}" class="btn btn-dark">ADD USER</a>
                        </div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                {{-- <th>Role</th> --}}
                                <th>Joined Date</th>
                                <th class="text-center action-column">Action</th>
                            </tr>
                        </thead>
                        <?php $count=1; ?>
                        @foreach($users as $id => $user)
                            <tbody>
                                <tr>
                                    <td>{{ $count ?? '' }}</td>
                                    <td>{{ $user->first_name ?? '' }}</td>
                                    <td>{{ $user->last_name ?? '' }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    {{-- <td>{{ $user->is_admin ?? 'user'}}</td> --}}
                                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <a href="{{url('/admin-dashboard/edit-user/'.$user->id)}}" class="btn btn-primary btn-sm me-3">Edit</a>
                                        <a href="{{url('/admin-dashboard/delete-user/'.$user->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php $count++; ?>
                        @endforeach
                    </table>
                </div>
            @else
                <p class="text-center">User Not Found</p>
            @endif    
        </div>
    </div>
@endsection