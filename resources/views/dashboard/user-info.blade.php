@extends('dashboard.layouts.app')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col" id="inf">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img
                                    class="img-fluid rounded mb-3 pt-1 mt-4"
                                    src="assets/img/avatars/15.png"
                                    height="100"
                                    width="100"
                                    alt="User avatar"
                                />
                                <div class="user-info text-center">
                                    <h4 class="mb-2">Violet Mendoza</h4>

                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                            <div class="d-flex align-items-start me-4 mt-3 gap-2">
                                <span class="badge bg-label-primary p-2 rounded"></span>
                                <div>

                                </div>
                            </div>
                            <div class="d-flex align-items-start mt-3 gap-2">
                                <span class="badge bg-label-primary p-2 rounded"></span>
                                <div>

                                </div>
                            </div>
                        </div>
                        <p class="mt-4 small text-uppercase text-muted">Details</p>
                        <div class="info-container">
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <span class="fw-semibold me-1">Username:</span>
                                    <span>violet.dev</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">Email:</span>
                                    <span>vafgot@vultukir.org</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">Status:</span>
                                    <span class="badge bg-label-success">Active</span>
                                </li>

                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">Tax id:</span>
                                    <span>Tax-8965</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">Contact:</span>
                                    <span>(123) 456-7890</span>
                                </li>
                                <li class="mb-2 pt-1">
                                    <span class="fw-semibold me-1">Languages:</span>
                                    <span>French</span>
                                </li>
                                <li class="pt-1">
                                    <span class="fw-semibold me-1">Country:</span>
                                    <span>England</span>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-center">
                                <a
                                    href="javascript:;"
                                    class="btn btn-primary me-3"
                                    data-bs-target="#editUser"
                                    data-bs-toggle="modal"
                                >Delete</a
                                >

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
                <!-- Plan Card -->
                <span class="badge bg-label-primary"
                      style="width: 100px;

        font-size: large;
        font-weight: bold;
        "

                >Goods</span>
                <div class="card mb-4" id="c-4">


                    <div class="card_goods" style="padding: 10px;">
                        <div class="g_img"
                             style="
                width: 100%;
                height: 170px;
                background-color: antiquewhite;
                "

                        >
                            <img src="assets/img/" alt=""
                                 width="100%"
                                 height="100%"
                            >
                        </div>
                        <span class="g_name">
                    <p>iphone 14 pro max</p>
                </span>

                        <span g_price >
                    <h4 style="
                    display: flex;
                    width: 70px;
                    background-color: rgb(255, 255, 0);
                    font-weight: bold;
                    border-radius: 20%;
                    padding: 5px;
                    color: rgba(22, 22, 22, 0.936);

                    ">2000$</h4>
                </span>
                        <div class="but"
                             style="display: flex;
                justify-content: space-around;"
                        >
                            <button class="b-a">
                                <label for="b-a">accept</label>

                            </button>
                            <button class="b-d">
                                <label for="b-d">reject</label>

                            </button>
                        </div>
                    </div>
                </div>
                <!-- /Plan Card -->
            </div>
        </div>
    </div>
@endsection
