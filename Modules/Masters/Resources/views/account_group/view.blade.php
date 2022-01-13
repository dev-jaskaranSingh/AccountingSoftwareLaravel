@extends('layouts.main')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Account Group Details</h5>
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

                            @foreach($model->toArray() as $key => $data)
                                @if(!in_array($key,['id']) )
                                    <tr>
                                        <td>{{ str_replace('_',' ',ucfirst($key)) }}</td>
                                        @if($key == 'children')
                                            @forelse($data as $key1 => $data1)
                                                <td>{{ $data1['name'] }}</td>
                                            @empty
                                                <td>No Data</td>
                                            @endforelse
                                        @elseif($key == 'parent')
                                            @forelse($data as $key1 => $data1)
                                                <td>{{ $data1['name'] }}</td>
                                            @empty
                                                <td>No Data</td>
                                            @endforelse
                                        @elseif($key == 'is_primary')
                                            <td>{!! $data == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>' !!} </td>
                                        @else
                                            <td>{{ $data}}</td>
                                        @endif
                                    </tr>
                                @endif


                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('master.account-groups.index') }}" class="btn btn-danger">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
