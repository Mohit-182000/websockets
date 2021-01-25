<div class="modal fade" id="addSalary" role="dialog" aria-labelledby="addSalary" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

                    <div class="modal-header">
                            <h5 class="modal-title">Salary</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>

                    <form action="{{ route('admin.salary.store') }} " method="post" id="salaryForm" name="salaryForm"  data-url="{{ route('check.exist') }}"  >
                        @csrf
                    <div class="modal-body">

                                <div class="row">

                                    <div class="col-md-12  pr-3">

                                        <div class="form-group">
                                            <label for="title">Salary <span class="text-danger">*</span></label>
                                            <input type="text" name="salary" id="salary"  data-rule-required="true" class="form-control"  data-rule-maxlength="10" >
                                        </div>

                                    </div>
                                </div>

                    </div>

                    <div class="card-footer">
                        <div class="float-right">

                            <button type="button" data-dismiss="modal" class="btn btn-sm btn-default">{{ __('common.btn_cancel') }}</button>
                             <button type="submit" class="btn btn-save-update btn-sm btn-success">{{ __('common.btn_save') }}</button>

                        </div>
                    </div>

                </form>


            </div>
    </div>
</div>


    <script src="{{ asset('assets/admin/js/validation/salary-validation.js') }}"></script>



