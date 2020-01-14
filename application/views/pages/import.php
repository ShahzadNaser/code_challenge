<div class="container  mt-6">
    <div class="col-md-10 col-md-offset-2">
        <h3>File Input Example</h3>
        <div id="msgBox" class="alert invisible" role="alert">

        </div>
        <form id="importForm" method="POST" action="#" enctype="multipart/form-data">
            <div class="form-group">
                <div class="input-group input-file" name="file">
                    <input type="text" class="form-control" id="fileInput" placeholder='Choose a file...' />			
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-choose text-white header-bg" type="button">Choose</button>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" id="frmSubmitBtn" class="btn btn-primary pull-right" disabled>Submit</button>
                <button type="reset" id="resetBtn" class="btn btn-danger">Reset</button>
            </div> 
        </form>
    </div>
</div>