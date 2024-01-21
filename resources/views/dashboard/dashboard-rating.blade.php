@extends('dashboard.layouts.app')
@section('title')
    Rating
@endsection
@push('custom-style')
    <style>
        .pointer {
            cursor: pointer;
        }

        .fa-times {
            color: rgb(214, 0, 0)
        }

        .ds-none {
            display: none
        }

        td,
        th {
            vertical-align: middle !important
        }

        .bold td {
            font-weight: 600
        }
        .bold-row td{
            font-weight: 500
        }
        .green {
            color: rgb(0, 111, 0)
        }
    </style>
@endpush
@section('content')
    <!-- right content -->
    <div id="content">

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <h2>Ratings</h2>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width:140px!important">Product Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th style="width:100px!important">Is Approved</th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ratings as $rating)
                                    @if ($rating->is_read == 0)
                                        @php $bold="bold-row" @endphp
                                    @else
                                        @php $bold="" @endphp
                                    @endif
                                    <tr class="{{$bold}}" id="{{ $rating->id }}">
                                        <td>{{ $rating->id }}</td>
                                        <td id="{{ $rating->id }}name">{{ $rating->name }}</td>
                                        <td id="{{ $rating->id }}email">{{ $rating->email }}</td>
                                        <td id="{{ $rating->id }}product">{{ $rating->product_name }}</td>
                                        <td id="{{ $rating->id }}msg">{{ $rating->description }}</td>
                                        <td  style="width:150px!important">{{ $rating->created_at }}</td>
                                        @if ($rating->is_approved == 0)
                                            <td>Pending</td>
                                        @else
                                            <td>Approved</td>
                                        @endif
                                        @if ($rating->is_approved == 1)
                                            <td><i class="fa fa-check pointer" {{-- onclick="lanuchModalReplay({{ $rating->id }})" --}} aria-hidden="true"></i>
                                            </td>
                                        @else
                                            <td><i class="fa fa-clock-o pointer"
                                                    onclick="lanuchModalApprove({{ $rating->id }})"
                                                    aria-hidden="true"></i></td>
                                        @endif
                                        </td>
                                        <td><i class="fa fa-times pointer" onclick="lanuchModalDelete({{ $rating->id }})"
                                                aria-hidden="true"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-replay" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Send Advertisement To<span class="receiver"></span>
                        </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form-send-message" action="/dashboard-send-contact" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="idSelected">
                            <input type="hidden" name="email" id="email" value="">
                            <input type="hidden" name="name" id="name" value="">
                            <div class="form-outline mb-4">
                                <label class="form-label" id="">Message</label>
                                <textarea name="msg" placeholder="Write Here Message Did You Want Send " id="desc" class="form-control"
                                    required cols="5" rows="5"></textarea>
                            </div>
                            <div class="spinner-border spinner-border-sm ds-none" style="display:none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="alert alert-success alert-success-send ds-none"
                                style="padding:8px 12px;font-size:14px" role="alert">
                                Sent Mail Successfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-approve" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Approve Rating</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        Do You Want To Approve This Rating?
                    </div>
                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px;margin:0 10px 10px "
                        role="alert">
                        Approved Seccuessfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="approve()">Confirm And Approve</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-delete" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Approve Rating</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        Do You Want To delete This Rating?
                    </div>
                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px;margin:0 10px 10px "
                        role="alert">
                        Delete Rating Seccuessfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="deleteRating()">Confirm And Delete</button>

                    </div>
                </div>
            </div>
        </div>
        @push('custom-script')
            <script>
                function lanuchModalDelete(id) {
                    $('.modal-delete').modal("show");
                    $("#idSelected").val(id)
                }
                function lanuchModalApprove(id) {
                    $('.modal-approve').modal("show");
                    $("#idSelected").val(id)
                }

                function lanuchModalReplay(id) {
                    $('.modal-replay').modal("show");
                    $("#idSelected").val(id)
                    $("#email").val($("#" + id + "email").text())
                    $("#name").val($("#" + id + "name").text())
                    $(".receiver").text($("#" + id + "name").text())


                }
                $("#form-send-message").submit(function(e) {

                    e.preventDefault(); // avoid to execute the actual submit of the form.

                    var form = $(this);
                    var actionUrl = form.attr('action');
                    $(".spinner-border").show();
                    $.ajax({
                        type: "POST",
                        url: actionUrl,
                        data: form.serialize(), // serializes the form's elements.
                        success: function(data) {
                            console.log(data)
                            $(".alert-success-send").show();
                            $(".spinner-border").hide();
                        }
                    });

                });

                function hideModal() {
                    $(".modal").each(function() {
                        $(this).modal("hide")
                    })
                }

                function approve() {
                    var id = $("#idSelected").val();
                    $.ajax({
                        method: "get",
                        url: "/dashboard-approve-rating",
                        data: {
                            'id': id,
                        }
                    }).done(function(data) {
                        $(".alert-success").show();
                        setTimeout(() => {
                            $(".alert-success").hide();
                            location.reload();
                        }, 3000);
                    });

                }
                function deleteRating() {
                    var id = $("#idSelected").val();
                    $.ajax({
                        method: "get",
                        url: "/dashboard-delete-rating",
                        data: {
                            'id': id,
                        }
                    }).done(function(data) {
                        $(".alert-success").show();
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    });
                }
                $(document).ready(function(){
                    $.ajax({
                    type: 'POST',
                    url: "/read-rating",
                    data: {
                        "_token": $('#token').attr('content'),
                    },

                    success: (data) => {
                    },
                    error: function(data) {}
                });
                })
            </script>
        @endpush


        <!-- Modal -->
        <!-- end dashboard inner -->
    @endsection
