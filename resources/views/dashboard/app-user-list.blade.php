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
                    @foreach($pending_products as $key => $product)
                        <tr>
                            <td>{{ ($key + 1) }}</td>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td><img src="{{ asset('storage/' . $product->path) }}" class="rounded-3" width="100px" height="100px" alt="•••" srcset=""></td>
                            <td><span class="bg-danger text-white p-2 rounded-2">{{ $product->status }}</span></td>
                            <td>
                                <a href="{{ route('approve_product', $product->id) }}" class="btn btn-success">Approve</a>
                                <a href="{{ route('reject_product', $product->id) }}" class="btn btn-danger">Reject</a>
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








@endsection
