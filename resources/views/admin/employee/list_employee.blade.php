@extends('layouts.app')

@section('title', 'admin')

@section('css_external_link')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('app-content')
    <!--- Content header --->
    @include('include.app.content_header', ['name' => 'List of employees', 'pre'=>'Employee', 'cur'=>'List'])
    <!--- Main content --->
    <br>

    <div class="container-fluid">
        <table id="list_employees" class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 0; text-align: center;"><small>#</small></th>
                    <th style="width: 0; text-align: center;"><small>UserId</small></th>
                    <th style="width: 10%; text-align: center;"><small>Name</small></th>
                    <th style="width: 10%; text-align: center;"><small>Email</small></th>
                    <th style="width: 0; text-align: center;"><small>Birthday</small></th>
                    <th style="width: 0; text-align: center;"><small>Phone</small></th>
                    <th style="width: 0; text-align: center;"><small>Department</small></th>
                    <th style="width: 5%; text-align: center;"><small>Position</small></th>
                    <th style="width: 0; text-align: center;"><small>Sex</small></th>
                    <th style="width: 0; text-align: center;"><small>Address</small></th>
                    <th style="width: 0; text-align: center;"><small>Country</small></th>
                    <th style="width: 30%; text-align: center;"><small>Image</small></th>
                    <th style="width: 0; text-align: center;"><small>Edit</small></th>
                </tr>
            </thead>

            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->id}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->user_id}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->last_name}} {{$employee->first_name}} </td>
                        <td style='text-align: center; vertical-align: middle'><small>{{explode("@", $employee->user()->first()->email)[0].' @'.explode("@", $employee->user()->first()->email)[1]}} </small> </td>
                        <td style='text-align: center; vertical-align: middle'> {{\Carbon\Carbon::parse($employee->birth_day)->format("d/m/Y")}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->phone}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->department}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->position}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->gender}} </td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->address}}</td>
                        <td style='text-align: center; vertical-align: middle'> {{$employee->country}}</td>
                        <td style='text-align: center; vertical-align: middle'>
                            <div class="card">
                                <img class="card-img-top" src="{{\Illuminate\Support\Facades\Storage::url($employee->image_profile)}}" alt="employee_image">
                            </div>
                        </td>
                        <td style='text-align: center; vertical-align: middle'>
                            <div class="btn btn-danger">
                                <a href="{{route('admin.employee.edit_view', ['employee_id'=>$employee->id])}}">
                                    <i class="fas fa-edit"></i>
                                    <small>Edit</small>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#list_employees').DataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bInfo": true,
                "bAutoWidth": true,
                "lengthMenu": [10, 20, 50, 100, 200, 500],
                /*
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );

                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
                */

            });
        });
    </script>
@endsection

