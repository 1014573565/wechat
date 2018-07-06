<style>
    @media (min-width: 992px){
        .modal-dialog {
            max-width: 992px;
            margin: 30px auto;
         }
    }


</style>

<div class="row">
    <div class="col-lg-12">
        <section class="card">
            <header class="card-header">
                <div class="card-actions">
                    <a href="#" class="card-action card-action-toggle" data-card-toggle></a>
                </div>

                <h2 class="card-title">预览</h2>
            </header>
            <div class="card-body" style="    height: 600px;
    overflow: auto;">
                {!! $html !!}


            </div>
        </section>
    </div>
</div>

<form class="form-horizontal form-admin container-fluid">
    <div class="form-group">
        <input type="hidden" name="file_name" value="{{ $file_name }}">
        <input type="submit" class="btn btn-primary float-right upload_submit" value="确定">
    </div>
</form>