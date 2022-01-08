@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Employees List</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Employee Code</th>
                                        <th>Father/Husband Name</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $key => $employee)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{ $employee->employee_name }}</td>
                                            <td>{{ $employee->employee_code }}</td>
                                            <td>{{ $employee->father_or_husband_name }}</td>
                                            <td>{{ $employee->gender }}</td>
                                            <td>{{ $employee->mobile }}</td>
                                            <td>
                                                <a href="{{ route('admin.employee.view',$employee->id) }}" class="btn btn-xs btn-warning">View</a>
                                                <a href="{{ route('admin.employee.edit',$employee->id) }}" class="btn btn-xs btn-info">Edit</a>
                                                <a href="{{ route('admin.employee.delete',$employee->id) }}" onclick="return confirm('Are you sure to delete?')" class="btn btn-xs btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Employee Name</th>
                                        <th>Father/Husband Name</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
