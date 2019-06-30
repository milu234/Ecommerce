@extends('layouts.adminLayout.admin_design')
@section('content')


<div id="content">
        <div id="content-header">
          <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Categories</a> </div>
          <h1>View Categories</h1>

             {{-- Flash message for invalid username and password  --}}
             @if(Session::has('flash_message_error'))
                
             <div class="alert alert-danger alert-block">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                     <strong>{!! session('flash_message_error') !!}</strong>
             </div>
         @endif
             {{-- end of the flash message --}}

             @if(Session::has('flash_message_success'))
             
             <div class="alert alert-success alert-block">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                     <strong>{!! session('flash_message_success') !!}</strong>
             </div>
         @endif




        </div>
        <div class="container-fluid">
          <hr>
          <div class="row-fluid">
            <div class="span12">
              <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                  <h5>View Categories</h5>
                </div>
                <div class="widget-content nopadding">
                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <?php $number = 1; ?>
                        <th>Sr.No</th>
                        <th>Category Name</th>
                        <th>Category Level</th>
                        <th>Category URL</th>
                        <th>Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                    <tr class="gradeX">
                    <td>{{ $number }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td>{{ $category->url }}</td>
                    <td class="center">
                      <a href="{{ url('/admin/edit-category/'.$category->id ) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a  rel="{{ $category->id }}" rel1="delete-category" href="javascript:" class="btn btn-danger btn-mini  deleteRecord ">Delete</a>
                      
                    </td>

                    <?php $number++;  ?>
                       
                    @endforeach
                       </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    
@endsection