@extends('dashboard.layouts.app')
@section('content')

    @if(session()->has('success'))
        <div class="content-wrapper mt-5 mx-5">
            <div class="alert alert-success" role="alert">
                <strong>{{ session()->get('success') }}</strong>
            </div>
        </div>

    @elseif(session()->has('error'))
        <div class="content-wrapper mt-5 mx-5">
            <div class="alert alert-danger" role="alert">
                <strong>{{ session()->get('error') }}</strong>
            </div>
        </div>
    @endif
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y table-light">
            <div class="table">
                <table class="table text-center bg-white">
                    <thead>
                    <tr>
                        <th scope="col" class="text-capitalize">#</th>
                        <th scope="col" class="text-capitalize">id</th>
                        <th scope="col" class="text-capitalize">name</th>
                        <th scope="col" class="text-capitalize">status</th>
                        <th scope="col" class="text-capitalize">created at</th>
                        <th scope="col" class="text-capitalize">Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                    @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ ($key + 1) }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name }}</td>
                            <td><span class="{{ $order->status == 'active' ? 'bg-success' : 'bg-danger' }} p-2 rounded-3 text-white">{{ $order->status }}</span></td>
                            <td>{{ $order->created_at }}</td>
                            <td>
                                @if($order->status == 'active')
                                    <button class="btn btn-success" data-bs-target="#showUserInfo{{$order->id}}" data-bs-toggle="modal">Information</button>
                                @elseif($order->status == 'pending')
                                    <a href="{{ route('approve_order', $order->id) }}" class="btn btn-success">Approve</a>
                                @endif
                                <a href="{{ route('reject_order', $order->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                    </tbody>
                </table>

                <div class="row mt-5">
                    <div class="col">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>




            {{-- End Modal --}}

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>





    @foreach($orders as $key => $order)
        <div class="modal fade" id="showUserInfo{{$order->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <p class="text-muted">{{ $order->id }}</p>
                        <p class="text-muted">{{ $order->user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




@endsection
