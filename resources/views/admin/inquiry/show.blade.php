<div class="modal fade" id="showcontact" role="dialog" aria-labelledby="showcontact" aria-hidden="true">

    <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" >Inquiry Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true"  data-msg-required="Brand is required." >&times;</span></button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                                     
                                        <table class="table table-borderless">
                                            <tbody>
                                                 <tr>
                                                    <td style="width: 117px;"><strong>Parent Name</strong></td>
                                                    <td class="text-muted"><p style="word-break: break-word;" class="m-0">{{ $inquiry->parent_name }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Child Name</strong></td>
                                                    <td class="text-muted"><p style="word-break: break-word;" class="m-0">{{ $inquiry->child_name }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Age / DOB</strong></td>
                                                    <td class="text-muted"><p style="word-break: break-word;" class="m-0">{{ $inquiry->child_name }}</p></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone</strong></td>
                                                    <td class="text-muted">{{ $inquiry->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <td ><strong>Email</strong></td>
                                                    <td class="text-muted"><p style="word-break: break-word;" class="m-0">{{ $inquiry->email ?? 'N/A' }}</p></td>
                                                </tr>
                                             
                                                 <tr>
                                                    <td style=" vertical-align: text-top;"><strong>Message</strong></td>
                                                    <td class="text-muted"><p style="word-break: break-word;" >{!! nl2br($inquiry->remark) ?? 'N/A' !!}</p></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                      

                                     
                                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="ik ik-x"></i>Close</button>
                    
                </div>

            </div>
 
    </div>
</div>

<!-- <div id="form-errors"></div> -->


