<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLongTitle">Team Details <span id="vendor_title_lable"></span></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div id="data-table_processing2" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}</div>
        <div class="form-row">
            <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Name</label>
                <div class="col-12">
                    <input type="text" class="form-control" value="{{$team->name}}">
                </div>
            </div>
            <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Email</label>
                <div class="col-12">
                    <input type="text" class="form-control" value="{{$team->email}}">
                </div>
            </div>
            
            <div class="form-group row width-100" id="reasonField" >
                <label class="col-12 control-label">Mobile Number</label>
                <div class="col-12">
                    <input type="text" class="form-control" value="{{$team->mobile_no}}">
                </div>
            </div>
    
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>