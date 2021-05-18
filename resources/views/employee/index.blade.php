@extends('layouts.app')

@section('title', 'employee')

@section('css-external-link')
@endsection

@section('app-content')
        <!--- Content Header --->
    @include('include.app.content_header', ['name' => 'Employee Page', 'pre' => 'Employee', 'cur' => 'Page'])
        <!--- Main content --->
        <section class="content">
            <div class="container-fluid">
                <row class="">
                    <div class="col-md-8 mx-auto" style="margin-top: 50px">
                        <div class="jumbotron">
                            <h1 class="display-4 text-success">Welcome to Employee Interface</h1>
                            <p class="lead">This is employee management application.</p>
                            <hr class="my-4">
                            <p></p>
                        </div>
                    </div>
                </row>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <!-- /.content-wrapper -->
@endsection
