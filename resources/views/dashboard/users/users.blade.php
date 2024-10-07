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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col d-flex justify-content-end">
                            <a href="{{ route('seller_users') }}" class="btn btn-warning btn-sm text-end">Seller Users</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table text-center bg-white">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-capitalize">#</th>
                                    <th scope="col" class="text-capitalize">id</th>
                                    <th scope="col" class="text-capitalize">name</th>
                                    <th scope="col" class="text-capitalize">last name</th>
                                    <th scope="col" class="text-capitalize">address</th>
                                    <th scope="col" class="text-capitalize">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->address ?? 'empty' }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-target="#showUserInfo{{$user->id}}" data-bs-toggle="modal">Information</button>
                                            <a href="{{ route('ban_user', $user->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>




            {{-- End Modal --}}

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>





    @foreach($users as $key => $user)
        <div class="modal fade" id="showUserInfo{{$user->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <h5>Products for {{ $user->name }}</h5>
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="row">
                            @if(count($user->product) > 0)
                                @foreach($user->product as $key => $product)
                                    <div class="col-md-6 mt-2">
                                        <div class="card" style="width: 20rem;">
                                            <img class="card-img-top" src="{{ asset('storage/' . $product->path) }}" alt="Card image cap">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $product->name }}</h4>
                                                <p class="card-text">{{ substr($product->description, 0, 20) . '...' }}</p>
                                                <p class="card-text">{{ $product->price . '$' }}</p>
                                                <p class="card-text"><span class="text-white p-2 rounded-3 {{ $product->status == 'active' ? 'bg-success' : 'bg-danger' }}">{{ $product->status }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="col">
                                    <p class="text-center text-danger">Empty Products for this user</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




@endsection
