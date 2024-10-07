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
            <div class="table-responsive">
                <table class="table text-center bg-white">
                    <thead>
                    <tr>
                        <th scope="col" class="text-capitalize">#</th>
                        <th scope="col" class="text-capitalize">id</th>
                        <th scope="col" class="text-capitalize">name</th>
                        <th scope="col" class="text-capitalize">price</th>
                        <th scope="col" class="text-capitalize">Image</th>
                        <th scope="col" class="text-capitalize">Status</th>
                        <th scope="col" class="text-capitalize">Actions</th>

                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($active_products as $key => $product)
                        <tr>
                            <td>{{ ($key + 1) }}</td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td><img src="{{ asset('storage/' . $product->path) }}" class="rounded-3" width="100px" height="100px" alt="•••" srcset=""></td>
                            <td><span class="bg-success text-white p-2 rounded-2">{{ $product->status }}</span></td>
                            <td>
                                <button class="btn btn-success" data-bs-target="#showUserInfo{{$product->id}}" data-bs-toggle="modal">Information</button>
                                <a href="{{ route('reject_product', $product->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>




            {{-- End Modal --}}

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>





    @foreach($active_products as $key => $product)
        <div class="modal fade" id="showUserInfo{{$product->id}}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <p class="text-muted">{{ $product->id }}</p>
                        <p class="text-muted">{{ $product->name }}</p>
                        <p class="text-muted">{{ $product->price }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach




@endsection
