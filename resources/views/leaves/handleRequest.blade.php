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
                        

                        

                        <div class="table-responsive">
                        
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Created</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Accept</th>
                                        <th>Reject</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requests as $req)
                                    <tr>
                                        <td>{{$req->user_id}}</td>
                                        <td>{{substr($req->created_at,0,10)}}</td>
                                        <td>{{$req->from_date}}</td>
                                        <td>{{$req->to_date}}</td>
                                        <td><p onclick="show_reason('{{$req->reason}}')">show</p></td>
                                        <td>{{$req->status}}</td>
                                        @if($req->status == "pending")
                                            <td>
                                                <a  class="btn btn-info btn-sm" onclick="handle_request(this,{{$req->id}})">Accept</a>
                                            </td>
                                            <td>
                                                
                                                <a class="btn btn-danger btn-sm"  onclick="handle_request(this,{{$req->id}})">Reject</a>
                                            </td>
                                        @else
                                            <td></td>
                                            <td></td>
                                        @endif
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

            <div class="modal fade" id="leaveModal" tabindex="-1" aria-labelledby="leaveModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <form action="" method="POST" id="leaveForm">
                      @csrf
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">New Leave Request</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>From:</p>
                        <input type="text" name="from" id="from">
                        <p>To</p>
                        <input type="text" name="to" id="to">
                        <div>
                        <p>Reason</p>
                        <textarea name="reason" id="reason" cols="5" rows="5"></textarea>
                         </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, Go back</button>
                      <button type="submit" class="btn btn-danger">submit</button>
                    </div>
                  </div>
              
                  </form>
                  
                </div>
            </div>

            <div class="modal fade" id="reasonModal" tabindex="-1" aria-labelledby="reasonModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="reasonModalLabel">Reason</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        
                        <div>
                        <textarea  id="reasonText" cols="5" rows="5"></textarea>
                         </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                                
                </div>
            </div>
@endsection
<script>
    document.addEventListener("DOMContentLoaded", function(event) { 
        $( function() {
      $( "#from,#to" ).datepicker();
    } );
});
    
</script>
<script>
    function show_reason(reason){
        console.log(reason)
        $('#reasonModal').modal('show')
        document.getElementById("reasonText").innerHTML = reason
    }
</script>
<script>
    function new_request(){
        console.log('deleting')
        $('#leaveModal').modal('show')
        var form = document.getElementById('leaveForm')
        form.action = '/leave-request/store'

    }
</script>
<script>
    function handle_request(obj,id){
            $.ajax({
            url: "/leave-request/admin/handle/"+id, 
            type : "post", 
            data:{"_token": "{{ csrf_token() }}","descision":obj.innerHTML +"ed"},
            success: function(result){
                if(obj.innerHTML=="Accept"){
                    obj.parentNode.nextElementSibling.children[0].remove()
                    obj.parentNode.previousElementSibling.innerHTML = "Accepted"
                }
                else{
                    obj.parentNode.previousElementSibling.children[0].remove()
                    obj.parentNode.previousElementSibling.previousElementSibling.innerHTML = "Rejected"
                }
                obj.remove()

               
            //obj.innerHTML = obj.innerHTML+"ed"
           // obj.onclick = ""
            },
            error: function () {
                
            }
            });	

        }

</script>

