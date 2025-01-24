@extends('admin_layout.master')
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            @if(isset($orders) && $orders->isNotEmpty())
                <div class="container">
                    <div class="header-container d-flex justify-content-between col-lg-12 p-2">
                        <div class="title-container p-2">
                            <h2 class="mb-4">Orders </h2>
                        </div>
                        <!-- <div class="button-container p-2">
                            <a href="{{ url('admin-dashboard/edit-user') }}" class="btn btn-dark">ADD USER</a>
                        </div> -->
                    </div>
                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>Created</th>
                                <!-- <th class="text-center action-column">Action</th> -->
                            </tr>
                        </thead>
                        <?php $count=1; ?>
                        @foreach($orders as $id => $order)
                            <tbody>
                                <tr>
                                    <td>{{ $count ?? '' }}</td>
                                    <td>{{ $order->order_num ?? '' }}</td>
                                    <td>{{ $order->user->first_name ?? '' }}</td>
                                    <td>${{ $order->amount ?? '' }}</td>
                                    <td>{{ $order->transactions->type ?? '' }}</td>
                                    <td>{{ $order->status ?? '' }}</td>
                                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
<!--                                     
                                    <td class="text-center">
                                        <a href="{{url('/admin-dashboard/edit-user/'.$order->id)}}" class="btn btn-primary btn-sm me-3">Edit</a>
                                        <a href="{{url('/admin-dashboard/delete-user/'.$order->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                    </td> -->
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