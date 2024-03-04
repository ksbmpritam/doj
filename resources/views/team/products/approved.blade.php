
<!--text/x-generic approved.blade.php ( ASCII text, with CRLF line terminators )-->
<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Product <span id="vendor_title_lable"></span></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="data-table_processing2" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="form-row">
            <div class="form-group row width-100">
                <label class="col-12 control-label">Status</label>
                <div class="col-12">
                    <select class="form-control form-select" name="team_approvel" id="team_approvel">
                        <option value="1" @if(old('team_approvel', $driver->team_approvel) == 1) selected @endif>Accept</option>
                        <option value="2" @if(old('team_approvel', $driver->team_approvel) == 2) selected @endif>Pending</option>
                        <option value="-1" @if(old('team_approvel', $driver->team_approvel) == -1) selected @endif>Reject</option>
                        <option value="0" @if(old('team_approvel', $driver->team_approvel) == 0) selected @endif>Process</option>
                    </select>
                    <div class="form-text text-muted">
                        @error('team_approvel')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            @if($driver->team_approvel==-1)
             <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Rejected By</label>
                <div class="col-12">
                    <input type="text" class="form-control" value="{{ ucfirst($driver->approved_by_name) }}">
                    
                </div>
            </div>
            @else
            <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Approved By</label>
                <div class="col-12">
                    <input type="text" class="form-control" value="{{ ucfirst($driver->approved_by_name) }}">
                    
                </div>
            </div>
            @endif
             @if($driver->team_approvel==-1)
             <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Reason</label>
                <div class="col-12">
                    <textarea class="form-control" rows="4" name="cancel_reason" id="cancel_reason">{{ $driver->cancel_reason }}</textarea>
                    <div class="form-text text-muted">
                        @error('cancel_reason')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
             @endif
    
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>