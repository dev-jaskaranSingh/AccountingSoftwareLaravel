<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5>Form Permissions <small>User forms permission form</small></h5>
            </div>
            <div class="ibox-content">
                <table class="table table-bordered table-striped">
                    <thead class="thead-light">
                    <tr>
                        <th>Forms</th>
                        <th colspan="4">Permissions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><strong>Form Name</strong></td>
                        <td><strong>Create</strong></td>
                        <td><strong>Read</strong></td>
                        <td><strong>Update</strong></td>
                        <td><strong>Delete</strong></td>
                    </tr>
                    @foreach($forms as $key => $form)
                        @php($userFormsPermission = $userForms->where('form_id', $form->id)->last())
                        <tr>
                            <td>
                                <strong>{!! $form->name !!} </strong>
                                <input type="hidden" name="forms[{{$form->id}}]" value="{!! $form->id !!}"/>
                            </td>
                            <td>
                                <input type="checkbox" name="forms[{{ $form->id }}][create]" value="1"
                                       @if(isset($userFormsPermission->create) && ($userFormsPermission->create == 1))
                                       checked @endif>
                            </td>
                            <td>
                                <input type="checkbox" name="forms[{{ $form->id }}][read]" value="1"
                                       @if(isset($userFormsPermission->read) && ($userFormsPermission->read == 1)) checked
                                    @endif>
                            </td>
                            <td>
                                <input type="checkbox" name="forms[{{ $form->id }}][update]" value="1"
                                       @if(isset($userFormsPermission->update) && ($userFormsPermission->update == 1))
                                       checked @endif>
                            </td>
                            <td>
                                <input type="checkbox" name="forms[{{ $form->id }}][delete]" value="1"
                                       @if(isset($userFormsPermission->delete) && ($userFormsPermission->delete == 1))
                                       checked @endif>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>



@section('scripts')

@endsection
