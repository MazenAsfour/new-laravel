@extends('dashboard.layouts.app')
@section('title')
    Users
@endsection
@push('custom-style')
    <style>

    </style>
@endpush
@section('content')
    <div id="content">

        <!-- dashboard inner -->
        <div class="midde_cont">
            <div class="container-fluid">
                <div class="row column_title">
                    <div class="col-md-12">
                        <div class="page_title" style="">
                            <h2 style="display: inline;">Users have 7 points and more</h2>

                        </div>
                    </div>
                </div>
                <div class="container">

                    <div class="well">
                        <div class="table-responsive">

                            <table class="table" id="userDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Points</th>
                                        <th>Free Meal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            jQuery(document).ready(function($) {
                prepare()

            });

            function prepare() {
                $(document).ready(function() {
                    $('#userDataTable').DataTable({
                        serverSide: true,
                        ajax: "{{ route('users-plus.data') }}",
                        columns: [{
                                data: 'id',
                                name: 'id',
                                render: function(data, type, row) {
                                    return '#' + row.id;
                                }
                            },
                            {
                                data: 'name',
                                name: 'name',
                                render: function(data, type, row) {
                                    return '<p id="name_' + row.id + '">' + row.name + '</p>';
                                }
                            },
                            {
                                data: 'email',
                                name: 'email',
                                render: function(data, type, row) {
                                    return '<p id="email_' + row.id + '">' + row.email +
                                        '</p>';
                                }
                            },
                            {
                                data: 'points',
                                name: 'points',
                                render: function(data, type, row) {
                                    return '<p id="points_' + row.id + '">' + row.points +
                                        ' Points</p>';
                                }
                            },
                            {
                                data: 'free_meal',
                                name: 'free_meal',
                                render: function(data, type, row) {
                                    return '<p id="free_meal_' + row.id + '">' + Math.floor(Number(row
                                            .points) / 7) +
                                        ' </p>';
                                }
                            }
                        ],
                    });
                });
            }

            function hideModal() {
                $(".modal").each(function() {
                    $(this).modal("hide")
                })
            }

            function destory() {
                jQuery('#userDataTable').DataTable().destroy();

            }
        </script>
    @endsection
