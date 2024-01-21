@extends('dashboard.layouts.app')
@section('title')
    Contact
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
                            <h2>Contact</h2>
                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Send At</th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>
                                    <th style="width: 15px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                    @if ($contact->is_read)
                                        <tr id="{{ $contact->id }}">
                                            <td>{{ $contact->id }}</td>
                                            <td id="{{ $contact->id }}name">{{ $contact->user_name }}</td>
                                            <td id="{{ $contact->id }}email">{{ $contact->user_email }}</td>
                                            <td style="width: 500px;">{{ $contact->message }}</td>
                                            <td style="width:200px">{{ $contact->created_at }}</td>
                                            @if ($contact->replayed)
                                                <td><i class="fa fa-check green" title="Replayed" aria-hidden="true"></i>
                                                </td>
                                            @else
                                                <td><i class="fa fa-comment" title="Replayed" aria-hidden="true"></i></td>
                                            @endif
                                            <td><i class="fa fa-reply pointer"
                                                    onclick="lanuchModalReplay({{ $contact->id }})" aria-hidden="true"></i>
                                            </td>
                                            <td><i class="fa fa-times pointer"
                                                    onclick="lanuchModalDelete({{ $contact->id }})" aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                    @else
                                        <tr id="{{ $contact->id }}" class="bold">
                                            <td>{{ $contact->id }}</td>
                                            <td id="{{ $contact->id }}name">{{ $contact->user_name }}</td>
                                            <td id="{{ $contact->id }}email">{{ $contact->user_email }}</td>
                                            <td style="width: 500px;">{{ $contact->message }}</td>
                                            <td>{{ $contact->created_at }}</td>
                                            @if ($contact->replayed)
                                                <td><i class="fa fa-check green" title="Replayed" aria-hidden="true"></i>
                                                </td>
                                            @else
                                                <td><i class="fa fa-comment" title="Replayed" aria-hidden="true"></i></td>
                                            @endif
                                            <td><i class="fa fa-reply pointer"
                                                    onclick="lanuchModalReplay({{ $contact->id }})"
                                                    aria-hidden="true"></i>
                                            </td>
                                            <td><i class="fa fa-times pointer"
                                                    onclick="lanuchModalDelete({{ $contact->id }})"
                                                    aria-hidden="true"></i>
                                            </td>
                                        </tr>
                                    @endif
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
                        <h5 class="modal-title" id="exampleModalLabel1"> Emailing With <span class="receiver"></span></h5>
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
                            <div class="spinner-border spinner-border-sm" style="display:none" role="status" >
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <div class="alert alert-success alert-success-send ds-none"
                                style="padding:8px 12px;font-size:14px" role="alert">
                                Sent Mail Successfully
                            </div>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block">Send Mail</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade modal-delete" id="staticBackdrop1" tabindex="-1" aria-labelledby="exampleModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-75">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Contact Message Want To Delete it</h5>
                        <button type="button" class="btn-close" onclick="hideModal()" data-mdb-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-3">
                        Do You Want To delete This Contact Message?
                    </div>
                    <div class="alert alert-success ds-none" style="padding:8px 12px;font-size:14px;margin:0 10px 10px "
                        role="alert">
                        Deleted Message Seccuessfully
                    </div>
                    <div class="modal-footer text-right">
                        <button class="btn btn-light" onclick="hideModal()">Cancel</button>
                        <button class="btn btn-primary" onclick="deleteUser()">Confirm And Delete</button>

                    </div>
                </div>
            </div>
        </div>
        @push('custom-script')
            <script>
                $(document).ready(function() {
                    $.ajax({
                        method: "get",
                        url: "/dashboard-mark-as-read",

                    }).done(function(data) {
                        
                    });

                })

                function lanuchModalDelete(id) {
                    $('.modal-delete').modal("show");
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

                function deleteUser() {
                    var id = $("#idSelected").val();
                    $.ajax({
                        method: "get",
                        url: "/dasboard-delete-contact",
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
            </script>
        @endpush


        <!-- Modal -->
        <!-- end dashboard inner -->
    @endsection
