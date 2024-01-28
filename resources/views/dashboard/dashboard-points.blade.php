@extends('dashboard.layouts.app')
@section('title')
    User Points
@endsection
@push('custom-style')
    <style>
        textarea {
            min-height: 200px !important
        }

        tr td:last-child {
            width: 100px !important;
        }

        tr td:nth-child(1) {
            width: 50px !important;
        }

        .bold-row td {
            font-weight: 500
        }
    </style>
@endpush
@section('content')
    <div id="content">

        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title">
                            <div class="row">
                                <div class="col-md-9">
                                    <h2 style="display: inline-block">User Points</h2>
                                </div>
                                <div class="col-md-3 d-flex justify-content-right">
                                    <select name="" class="form-control" id="filler-date">
                                        <option value="1">Current Day</option>
                                        <option value="0">All Requests</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table id="pointsDataTable" class="table  table-striped">
                        <thead>
                            <tr>
                                <th>Request ID</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>


            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-insert" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Add Menu Item</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <form id="form" method="POST" action="/upload-image" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="small-12 medium-2 large-2 columns">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Category Name</label>
                                        <input type="text" id="pr_name" placeholder="Name" name="name" required
                                            class="form-control" />
                                    </div>

                                    <input type="hidden" name="type" value="">
                                    <input type="hidden" name="id" id="_id">

                                    <div class="form-outline mb-4">
                                        <label class="form-label" id="">Description</label>
                                        <textarea name="description" placeholder="Description" class="form-control" cols="4" rows="4"></textarea>
                                    </div>
                                    <div class="alert alert-success-insert alert-success ds-none"
                                        style="padding:8px 12px;font-size:14px" role="alert">
                                        Added Item Successfully
                                    </div>
                                    <div class="spinner-border spinner-border-sm d-none" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Add Item
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade modal-update" id="" tabindex="-1" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog d-flex justify-content-center">
                <div class="modal-content w-100">
                    <div class="modal-header">
                        <h5 class="modal-title" id=""> Update <span id="request_id_hash"></span> </h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal"onclick="hideModal()"
                            aria-label="Close"></button>
                    </div>
                    <form id="form-update" action="/upload-image" method="POST">

                        <div class="modal-body p-4">
                            @csrf
                            <div class="row">
                                <div id="process_name"></div>
                                <input type="hidden" id="request_id" name="request_id" required class="form-control" />
                                <input type="hidden" id="convert_to" name="convert_to" required class="form-control" />

                                <div class="alert alert-success-update mt-2 alert-success ds-none"
                                    style="padding:8px 12px;font-size:14px" role="alert">
                                    Updated Successfully
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer p-2">
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            jQuery(document).ready(function($) {
                prepare()

                $.ajax({
                    type: 'POST',
                    url: "/dashboard-all-requests-reads",
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: (data) => {

                    },
                    error: function(data) {
                        console.log(data)
                    }
                });
            });

            function prepare(isCurrentDay = 0) {
                $('#pointsDataTable').DataTable({
                    serverSide: true,
                    ajax: "/dashboard-points/data?isCurrentDay=" + isCurrentDay,
                    data: {
                        "isCurrentDay": jQuery("#filler-date").val(),
                    },
                    columns: [{
                            data: 'request_id',
                            name: 'request_id',
                            render: function(data, type, row) {

                                return '#' + row.id;
                            }
                        },
                        {
                            data: 'username',
                            name: 'username',
                            render: function(data, type, row) {
                                return '<p id="name_' +
                                    row.id + '">' + row.name + '</p>';
                            }
                        },
                        {
                            data: 'email',
                            name: 'email',
                            render: function(data, type, row) {
                                return '<p  id="email_' +
                                    row.id + '">' + row.email + '</p>';
                            }
                        },
                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, row) {
                                return '<p id="create_at_' + row.created_at + '">' +
                                    formatReadableDate(row.created_at) +
                                    '</p>';
                            }
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                return '<p id="status_' + row.id + '">' + (Number(row.status) === 0 ?
                                    'Pending' : 'Approved') + '</p>';

                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                convertTo = (Number(
                                        row.status) === 0 ?
                                    1 : 0)
                                return '<button class="btn btn-primary" onclick="setRequest(' + row.id + ',' +
                                    convertTo +
                                    ')" id="status_' + row.id + '">' + (Number(
                                            row.status) === 0 ?
                                        'Approve' : 'Denied') + '</button>';
                            }
                        }
                    ],
                    createdRow: function(row, data, dataIndex) {
                        console.log(data.is_admin_read)

                        if (Number(data.is_admin_read) == 0) {
                            $(row).addClass('bold-row');
                        }
                    }
                });

            }

            function setRequest(request_id, to) {
                $("#request_id_hash").text(" row #" + request_id)
                if (to == 1) {
                    var warining = "Make sure when approve this request user will earn one point!";
                } else {
                    var warining = "Make sure when denied this request user will loss one point!";
                }
                $("#process_name").text(warining);

                $("#convert_to").val(to)
                $("#request_id").val(request_id)
                $('.modal-update').modal("show");

            }


            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }

            $(document).ready(function() {
                jQuery("#filler-date").change(function() {
                    destory()
                    prepare($(this).val())
                })
                $('#form-update').submit(function(e) {
                    e.preventDefault();
                    $("#form-update .spinner-border").removeClass("d-none")
                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "/dashboard-update-status",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            res = JSON.parse(data)
                            $("#form-update .spinner-border").addClass("d-none")
                            if (res.success) {
                                $(".alert-success-update").show();
                                destory();
                                prepare();
                            } else {
                                alert(res.error)
                            }
                            setTimeout(() => {
                                $(".modal-update").modal("hide")
                                $(".modal-update .alert-success").hide();

                            }, 3000);
                        },
                        error: function(data) {
                            console.log(data)
                        }
                    });
                });
            });

            function formatReadableDate(dateString) {
                var date = new Date(dateString);

                var optionsDate = {
                    year: 'numeric',
                    month: 'short',
                    day: 'numeric'
                };
                var optionsTime = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    // timeZoneName: 'short'
                };

                var formattedDate = date.toLocaleDateString('en-US', optionsDate);
                var formattedTime = date.toLocaleTimeString('en-US', optionsTime);

                return formattedDate + ' ' + formattedTime;
            }

            function destory() {
                jQuery('#pointsDataTable').DataTable().destroy();

            }
        </script>
    @endsection
