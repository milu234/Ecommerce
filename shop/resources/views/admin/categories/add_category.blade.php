@extends('layouts.adminLayout.admin_design')
@section('content')
    

<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">  Categories </a> <a href="#" class="current">Add Category</a> </div>
          <h1>Form validation</h1>
        </div>
        <div class="container-fluid"><hr>
          <div class="row-fluid">
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                  <h5>Add Category</h5>
                </div>
                <div class="widget-content nopadding">
                  <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate="novalidate">
                    <div class="control-group">
                      <label class="control-label">Your Name</label>
                      <div class="controls">
                        <input type="text" name="required" id="required">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Your Email</label>
                      <div class="controls">
                        <input type="text" name="email" id="email">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Date (only Number)</label>
                      <div class="controls">
                        <input type="text" name="date" id="date">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">URL (Start with http://)</label>
                      <div class="controls">
                        <input type="text" name="url" id="url">
                      </div>
                    </div>
                    <div class="form-actions">
                      <input type="submit" value="Validate" class="btn btn-success">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>



@endsection