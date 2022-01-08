
@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Details</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user->toArray() as $key => $employee)
                                    @if(!in_array($key,['id','password','forms']) )
                                    <tr>
                                        <td>{{ str_replace('_',' ',ucfirst($key)) }}</td>
                                        @if($key == 'is_active' || $key == 'is_admin')
                                            <td>{!! $employee ? '<span class="badge badge-success">True</span>' : '<span class="badge badge-success">False</span>'  !!}</td>
                                        @elseif($key == 'created_at' || $key == 'updated_at')
                                            <td>{{ date('d-m-Y',strtotime($employee)) }}</td>
                                        @elseif($key == 'profile_photo_url')
                                            <td><img src="{{$employee}}" width="100"/></td>
                                        @else
                                            <td>{{ $employee}}</td>
                                        @endif
                                    </tr>
                                    @endif

                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
