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
                            <a href="{{ route('all_users') }}" class="btn btn-success btn-sm text-end">All Users</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table text-center bg-white">
                                <thead>
                                <tr>
                                    <th scope="col" class="text-capitalize">#</th>
                                    <th scope="col" class="text-capitalize">name</th>
                                    <th scope="col" class="text-capitalize">last name</th>
                                    <th scope="col" class="text-capitalize">address</th>
                                    <th scope="col" class="text-capitalize">number of sold items</th>
                                    <th scope="col" class="text-capitalize">items in store</th>
                                    <th scope="col" class="text-capitalize">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ ($key + 1) }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->address ?? 'empty' }}</td>
                                        <td>{{ $user->number_of_sold_items }}</td>
                                        <td>{{ $user->items_in_store }}</td>
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
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <p class="text-muted">{{ $user->id }}</p>
                        <p class="text-muted">{{ $user->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




@endsection
