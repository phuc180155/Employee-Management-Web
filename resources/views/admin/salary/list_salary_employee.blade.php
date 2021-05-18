@extends('layouts.app')

@section('title', 'admin')

@section('css_external_link')
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"/>--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>
    <!-- Date range picker -->
@endsection

@section('app-content')
    <!--- Content header --->
    @include('include.app.content_header', ['name' => 'Employees Salary on '.$title, 'pre'=>'Admin', 'cur'=>'List salary'])
    <!--- Main content --->
    <br>

    <div class="container-fluid">
        <div class="card">

            <div style="padding-top: 20px" class="card-header bg-outline-secondary">
                <div class="card-title">
                    <div class="row">
                        <div class="col-lg-12 mx-auto">
                            <!-- Option to select all or specific month -->
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                <h4><i style="color: yellow" class="fas fa-bars">???</i><strong>&nbsp;&nbsp;Option filter</strong></h4>
                            </button>

                            <div class="dropdown-menu">
                                <button id="specific-month" type="button" class="btn btn-info">Get a specific month</button>
                                <div style="margin-top:1px; margin-bottom: 1px !important;" class="dropdown-divider"></div>
                                <form action="{{route('admin.salary.employee_salary_select')}}" method="post">
                                    @csrf
                                    <button name="all" type="submit" class="btn btn-info" value="all">Get all month</button>
                                </form>
                            </div>
                            <br>
                            <br>

                            <form id="month-form" style="{{count($errors) > 0 ? 'display: block' : 'display:none'}}" action="{{route('admin.salary.employee_salary_select')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <div class="col-sm-1">
                                        <label style="margin-top: 5px" for="monthid"><strong>Month </strong> </label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input name="month" type="month" class="form-control" id="monthid" placeholder="{{old('month')}}">
                                        @error('month')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div style="padding-bottom: -20px" class="col-sm-4">
                                        <input type="submit" name="" class="btn btn-dark" value="Get a specific month">
                                    </div>
                                </div>
                            </form>

                            {{--                        <form id="all-month-form" style="display: none" action="{{route('admin.salary.employee_salary_select')}}" method="post">--}}
                            {{--                            {{csrf_field()}}--}}
                            {{--                            <div class="form-group row">--}}
                            {{--                                <div class="col-sm-4">--}}
                            {{--                                    <input name="all" type="submit" class="btn btn-dark" value="Get all">--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}
                            {{--                        </form>--}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <br>
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <table class="table table-bordered table-hover" id="list_salaries">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%; text-align: center;">#</th>
                                    <th style="width: 20%; text-align: center;">Month</th>
                                    <th style="width: 15%; text-align: center;">Name</th>
                                    <th style="width: 0; text-align: center;">Department</th>
                                    <th style="width: 0; text-align: center;">Position</th>
                                    <th style="width: 0; text-align: center;">Subsidy</th>
                                    <th style="width: 0; text-align: center;">Allowance</th>
                                    <th style="width: 0; text-align: center;">Insurance</th>
                                    <th style="width: 20%; text-align: center;">Salary</th>
                                    <th style="width: 0; text-align: center;">Action</th>

                                    <!--- Detail --->
                                    <th style="display: none">Email</th>
                                    <th style="display: none">Base Salary</th>
                                    <th style="display: none">Number of dayoff</th>
                                    <th style="display: none">Number of dayon</th>
                                    <th style="display: none">Number of dayleave</th>
                                    <th style="display: none">Number of overtimehours</th>
                                    <th style="display: none">Number of undertimehours</th>
                                    <th style="display: none">Number of max leaves</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($list_salary); $i++)
                                    <tr>
                                        <td style='text-align: center; vertical-align: middle'> {{$i + 1}} </td>
                                        <td style='text-align: center; vertical-align: middle'> {{$list_salary[$i]->month}} </td>
                                        <td style='vertical-align: middle'> {{$list_salary[$i]->name}} </td>
                                        <td style='vertical-align: middle'> {{$list_employee[$i]->department}} </td>
                                        <td style='vertical-align: middle'> {{$list_employee[$i]->position}} </td>
                                        <td style='text-align: center; vertical-align: middle'> {{$list_salary[$i]->subsidy??'null'}} </td>
                                        <td style='text-align: center; vertical-align: middle'> {{$list_salary[$i]->allowance??'null'}} </td>
                                        <td style='text-align: center; vertical-align: middle'> {{$list_salary[$i]->insurance??'null'}} </td>
                                        <td id="total_salary_{{$i+1}}"style='text-align: center; vertical-align: middle'> {{$list_salary[$i]->take_home_pay??'null'}} </td>
                                        <td style='text-align: center; vertical-align: middle'>
                                                                                        <!-- Dropdown menu action -->
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    <i style="color: red" class="fas fa-bars"></i> &nbsp;Menu
                                                </button>
                                                <div style="width: 100px" class="dropdown-menu">
                                                    <input id="info-detail-{{$i+1}}" type="button" style="width: 100px" class="btn btn-info" value="Detail">
                                                    <div style="margin-top:1px; margin-bottom: 1px !important;" class="dropdown-divider"></div>
                                                    <a  style="width: 100px" class="btn btn-success" href="{{route('admin.salary.update_fee', [$list_salary[$i]->id, $title])}}">Update</a>
                                                    <div style="margin-top:1px; margin-bottom: 1px !important;" class="dropdown-divider"></div>
                                                    <a style="width: 100px" class="btn btn-secondary" href="{{route('admin.salary.calculate_salary', [$list_salary[$i]->id, $title])}}">Calculate</a>
                                                    <div style="margin-top:1px; margin-bottom: 1px !important;" class="dropdown-divider"></div>
                                                    <a style="width: 100px" class="btn btn-danger" href="#">Delete</a>
                                                    <div style="margin-top:1px; margin-bottom: 1px !important;" class="dropdown-divider"></div>
                                                </div>

{{--                                                <span id="button-{{$index+1}}"><i class="far fa-bars"></i></span>  -->--}}
{{--                                                                                                <span class="test{{$index+1}}" id="button-{{$index+1}}" ><i class="fas fa-plus-circle " style="padding-top:6px;color:blue"></i></span>--}}


                                        </td>
                                        <!-- Detail -->
                                        <td>{{$list_employee[$i]->user()->first()->email}}</td>
                                        <td>{{$list_employee[$i]->base_salary}}</td>
                                        <td>{{$list_info_detail[$i]->number_dayoff}}</td>
                                        <td>{{$list_info_detail[$i]->number_dayon}}</td>
                                        <td>{{$list_info_detail[$i]->number_dayleft}}</td>
                                        <td>{{$list_info_detail[$i]->overtime_workings}}</td>
                                        <td>{{$list_info_detail[$i]->undertime_workings}}</td>
                                        <td>{{$list_employee[$i]->max_leaves}}</td>

                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

        {{--    source: https://datatables.net/examples/api/row_details.html --}}
        <script>
            $('#specific-month').on('click', function(){

                if ($('#month-form').is(":visible")) {
                    $('#month-form').css("display", "none");
                } else {
                    $('#month-form').css("display", "block");
                }
           });
        </script>
        <!-- DataTables -->
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

        <script>
            /* Formatting function for row details - modify as you need */
            function format(d ) {
                // `d` is the original data object for the row
                // let overtime = parseFloat(d.overtime);

                let this_format = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                    '<tr>' +
                    '<td><strong>Email</strong></td>' +
                    '<td>' + d.email + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong>Base salary</strong></td>' +
                    '<td>' + d.base + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Day off</strong></td>' +
                    '<td>' + d.dayoff + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Day on</strong> </td>' +
                    '<td>' + d.dayon + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Day left </strong></td>' +
                    '<td>'+ d.dayleave + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Overtime hours</strong> </td>' +
                    '<td>' + d.overtime + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Undertime hours</strong> </td>' +
                    '<td>' + d.undertime + '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td><strong> Max leaves</strong> </td>' +
                    '<td>' + d.maxleaves + '</td>' +
                    '</tr>'
                this_format += '</table>';
                return this_format;
            }

            $(document).ready(function() {

                let status_calculate = '{{$status_calculate??'null'}}';
                if (status_calculate == 'true'){
                    window.alert('Calculate salary success');
                } else if (status_calculate == 'false') {
                    window.alert('There is a null field');
                }

                let table = $('#list_salaries').DataTable({
                    "responsive": false,
                    "bAutoWidth": true,

                    "bPaginate": true,
                    "bLengthChange": true,
                    "bInfo": true,
                    "lengthMenu": [10, 20, 50, 100, 200, 500],
                    "columns": [

                        {"data": "#"},
                        {"data": "month"},
                        {"data": "name"},
                        {"data": "department"},
                        {"data": "position"},
                        {"data": "subsidy"},
                        {"data": "allowance"},
                        {"data": "insurance"},
                        {"data": "salary"},
                        {
                            "className": 'details-control',
                            "orderable": false,
                            "data": 'action',
                            "defaultContent": ''
                        },
                        {"data": "email",  "visible": false},
                        {"data": "base",  "visible": false},
                        {"data": "dayoff",  "visible": false},
                        {"data": "dayon",  "visible": false},
                        {"data": "dayleave",  "visible": false},
                        {"data": "overtime",  "visible": false},
                        {"data": "undertime",  "visible": false},
                        {"data": "maxleaves",  "visible": false},
                    ],
                    "order": [[1, 'asc']]
                });

                // Add event listener for opening and closing details
                $('input').on('click', function (e) {
                    let idClicked = '#'+e.target.id;
                    let tr = $(idClicked).parent().parent().parent();
                    let row = table.row(tr);
                    let index = idClicked.slice(-1);
                     if (row.child.isShown()) {
                        //$(this).find('#button-'+index).replaceWith(`<span id="button-${index}"><i class="fas fa-plus-circle " style="padding-top:6px;color:blue"></i></span>`);
                        // $('#button').replaceWith('<span id="button"><i class="fas fa-plus-circle " style="color:green"></i></span>');
                        // This row is already open - close it
                        row.child.hide();
                        tr.removeClass('shown');
                    } else {

                        // Open this row
                        //$(this).find('#button-'+index).replaceWith(`<span id="button-${index}"><i class="fas fa-minus-circle " style="padding-top:6px;color:red"></i></span>`);
                        // $('#button').replaceWith('<span id="button"><i class="fas fa-minus-circle " style="color:red"></i></span>');
                        row.child(format(row.data())).show();
                        tr.addClass('shown');
                    }
                });
            });
        </script>
@endsection

