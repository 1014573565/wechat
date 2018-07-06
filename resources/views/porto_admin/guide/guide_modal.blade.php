{{--管理员列表--}}
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">修改导游</h4>
</div>
<div class="modal-body">
    <form class="form-horizontal form-admin container-fluid">
        <div class="form-group row">
            <label class="col-sm-3 col-md-2 pt-2 pr-0 pl-0">导游名：</label>
            <input type="text" class="col-sm-9 col-md-10 form-control" name="name" value="{{ $user->name }}">
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">手机号：</label>
            <input type="text" class="col-sm-9 col-md-10 form-control" name="mobile" value="{{ $user->mobile }}">
        </div>
        {{--<div class="form-group row">
            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">密码：</label>
            <input type="text" class="col-sm-9 col-md-10 form-control" name="password" value="{{ $user->password }}">
        </div>--}}
        {{--<div class="form-group row">
            <label class="col-sm-3 col-md-2 control-label pt-2 pr-0 pl-0">驾照：</label>
            <input type="text" class="col-sm-9 col-md-10 form-control" name="license" value="{{ $user->license }}">
        </div>--}}
        <div class="form-group">
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="submit" class="btn btn-primary float-right admin_modify" value="确定">
        </div>
    </form>
</div>
