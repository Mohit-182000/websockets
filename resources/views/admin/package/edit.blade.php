@extends('admin.layout.app')

@section('title','Package')

@section('content')

<div class="container-fluid">
    
    <div class="row">

        @include('component.error')

        <div class="col-sm-6">

            <form action="{{ route('admin.package.update',($employer_package->id ?? 0)) }}" method="POST" name="employerPackageForm" id="employerPackageForm" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Employer Package</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input id="name" class="form-control" type="text" name="name"
                                        data-rule-required="true"
                                        value="{{$employer_package->name ?? ''}}"
                                        data-msg-required="Name is required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">Price <span class="text-danger">*</span></label>
                                        <input id="price" class="form-control" type="text" name="price"
                                        data-rule-required="true"
                                        data-rule-digits="true"
                                        data-rule-maxlength="5"
                                        value="{{$employer_package->price ?? ''}}"
                                        data-msg-required="Price is required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="des">Description <span class="text-danger">*</span></label>
                                        <textarea id="des" class="form-control" type="text" name="description"
                                        data-rule-required="true"
                                        data-rule-maxlength="191"
                                        data-msg-required="Description is required">{{$employer_package->description ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="validity">Validity ( In Days )  <span class="text-danger">*</span></label>
                                        <input id="validity" class="form-control" type="text" name="validity"
                                        data-rule-required="true"
                                        value="30"
                                        readonly
                                        data-msg-required="Validity is required">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="package_user_type" value="{{$employer_package->package_user_type ?? 'EMPLOYER'}}">
                        </div>
                        <div class="card-footer">
                                <div class="float-right">    
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                            </div>
                    </div>
            </form>
        </div>

        <div class="col-sm-6">

            <form action="{{ route('admin.package.update',($jobseeker_package->id ?? 0)) }}" method="POST" name="jobseekerPackageForm" id="jobseekerPackageForm" enctype="multipart/form-data">
                @csrf
                @method('PUT') 

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Jobseeker Package</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input id="name" class="form-control" type="text" name="name"
                                        data-rule-required="true"
                                        value="{{$jobseeker_package->name ?? ''}}"
                                        data-msg-required="Name is required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="price">Price <span class="text-danger">*</span></label>
                                        <input id="price" class="form-control" type="text" name="price"
                                        data-rule-required="true"
                                        data-rule-digits="true"
                                        data-rule-maxlength="5"
                                        value="{{$jobseeker_package->price ?? ''}}"
                                        data-msg-required="Price is required">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="des">Description <span class="text-danger">*</span></label>
                                        <textarea id="des" class="form-control" type="text" name="description"
                                        data-rule-required="true"
                                        data-rule-maxlength="191"
                                        data-msg-required="Description is required">{{$jobseeker_package->description ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="validity">Validity ( In Days )  <span class="text-danger">*</span></label>
                                        <input id="validity" class="form-control" type="text" name="validity"
                                        data-rule-required="true"
                                        value="30"
                                        readonly
                                        data-msg-required="Validity is required">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="package_user_type" value="{{$jobseeker_package->package_user_type ?? 'JOBSEEKER'}}">
                        </div>
                        <div class="card-footer">
                                <div class="float-right">    
                                    <button type="submit" class="btn btn-sm btn-success">Update</button>
                                </div>
                            </div>
                    </div>
            </form>
        </div>

    </div>

    
</div>
@endsection

@push('js')
<script src="{{ asset('assets/admin/js/setting/package.js') }}"></script>
@endpush


