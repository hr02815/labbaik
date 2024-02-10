@extends('layouts.app')

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
                <div class="row">
                    <div>
                        <!-- Button trigger modal -->
                        <a data-toggle="modal" href="{{route("users.create")}}"class="btn btn-success header-btn hidden-mobile"><i class="fa fa-circle-arrow-up fa-lg"></i> Create User</a>
                    </div>
                </div>

                

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        {{-- <p>Adds borders to any table row within <code>&lt;table&gt;</code> by adding the <code>.table-bordered</code> with the base class</p>
                         --}}
                        <div class="table-responsive">
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>History</th>
                                        <th>Pay slip</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < count($users); $i++)
                                    <tr>
                                        <td>{{$users[$i]->id}}</td>
                                        <td>{{$users[$i]->name}}</td>
                                        <td>{{$users[$i]->email}}</td>
                                        <td>{{$users[$i]->role->name}}</td>
                                        <td>
                                            <a href="{{route('users.history',$users[$i]->id)}}" class="btn btn-info btn-sm">History</a>
                                        </td>
                                        <td>
                                            <a onclick="handle_payslip_generate({{$users[$i]->id}})" class="btn btn-info btn-sm">Generate</a>
                                        </td>
                                        <td>
                                            <a href="{{route('users.edit',$users[$i]->id)}}" class="btn btn-info btn-sm">edit</a>
                                        </td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" onclick="handle_delete({{$users[$i]->id}})">delete</button>
                                        </td>
                                    </tr>
    
                                    @endfor
                                    
                                    
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
                  <form action="" method="POST" id="deleteUserForm">
                      @csrf
                      @method('DELETE')
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-center text-bold">
                      Are you sure you want to delete this User?
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

            <div class="modal fade" id="paySlipModal" tabindex="-1" aria-labelledby="paySlipModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" method="POST" id="paySlipForm">
                      @csrf
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Pay Slip</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="text-bold">
                      Please select month and the year of the payslip:
                      </p>
                      <select name="month" value = "{{date('m')}}">
                        
                        
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <input type="text" id = "year" name="year" value = "{{date("Y")}}" data-mask="2099">
                    <div>
                        <br>
                    <p>Please enter number of days off in the month:</p>
                    <input type="number" id = "holidays" name="holidays" max="31" value="0">
                    <div>
                    <br>
                    <p>Please enter number of daily working hours:</p>
                    <input type="number" id = "workingHrs" name="workingHrs" max="24" value="0">
                </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go back</button>
                      <button type="submit" class="btn btn-danger">Yes, Generate</button>
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
        var form = document.getElementById('deleteUserForm')
        form.action = '/user/' + id

    }
    function handle_payslip_generate(id){
        console.log('generate',id)
        //$opt = document.getElementsByTagName("option");
        $month = parseInt(document.getElementsByTagName("select")[0].value)
        console.log('month ',$month)
        document.getElementsByTagName("select")[0].options.selectedIndex = $month - 1
        //$opt[$month].selected
        if($month == 1){
            document.getElementById("year").value = document.getElementById("year").value - 1
            document.getElementsByTagName("select")[0].options.selectedIndex =11
            
        }
        //$opt[(int)document.getElementsByTagName("select")[0].value].selected
        if(document.get)
        console.log('generate',id)
        
        $('#paySlipModal').modal('show')
        var form = document.getElementById('paySlipForm')
        form.action = '/generate-pdf/user/' + id

    }
</script>


