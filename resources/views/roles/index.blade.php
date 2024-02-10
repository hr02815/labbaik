@extends('layouts.app');

@section('content')
@if(session()->has('success'))
<div class="alert alert-block alert-success">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> {{session()->get('success')}}</h4>
</div>
@elseif (session()->has('fail'))
<div class="alert alert-danger">
    {{session()->get('fail')}}
</div>
@endif
                    
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-0" data-widget-editbutton="false">
                <!-- widget options:
                usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                data-widget-colorbutton="false"
                data-widget-editbutton="false"
                data-widget-togglebutton="false"
                data-widget-deletebutton="false"
                data-widget-fullscreenbutton="false"
                data-widget-custombutton="false"
                data-widget-collapsed="true"
                data-widget-sortable="false"

                -->
                

                

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <div>
                            <!-- Button trigger modal -->
                            <a data-toggle="modal" href="/roles/create"class="btn btn-success header-btn hidden-mobile"><i class="fa fa-circle-arrow-up fa-lg"></i> Create Role</a>
                        </div>

                        

                        <div class="table-responsive">
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Employees</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td><a href="/showUserListing?role={{$role->id}}" class="btn btn-info btn-sm">{{count($role->users)}}</a></td>
                                        <td>
                                            <a href="{{route('roles.edit',$role->id)}}" class="btn btn-info btn-sm">edit</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="handle_delete({{$role->id}})">delete</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" method="POST" id="deleteRoleForm">
                      @csrf
                      @method('DELETE')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Role</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-center text-bold">
                      Are you sure you want to delete this Role?
                      </p>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go back</button>
                      <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    </div>
                  </div>
              
                  </form>
                  
                </div>
            </div>
@endsection

<script>
    function handle_delete(id){
        console.log('deleting',id)
        $('#deleteModal').modal('show')
        var form = document.getElementById('deleteRoleForm')
        form.action = '/roles/' + id

    }
</script>
