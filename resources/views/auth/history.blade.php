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
{{-- <div class="alert alert-block alert-success">
	<fieldset>
        <div class="row">
            <section class="col col-4">
                <h5>Total Working Hours</h5>
            </section>
            <section class="col col-4">
                <h5 >Hours Spent</h5>
            </section>
            <section class="col col-4">
                <h5>Hours Remaining</h5>
            </section>
        </div>
    
        <div class="row">
            <section class="col col-4">
                <label id="totalWorkingHrs"></label>        
            </section>
            <section class="col col-4">
                <label id="hoursSpent"></label>        
            </section>
            <section class="col col-4">
                <label id="remainingHrs"></label>        
            </section>
        </div>
    </fieldset>
</div> --}}


<!-- widget grid -->
<div class="row" style="display: flex;justify-content: center; align-items: center; margin-bottom: 5px">
    
    <div class="col col-sm-4"style="display: flex;justify-content: center; align-items: center;">
        <div class="card text-white bg-primary mb-3" style="display: flex;justify-content: center; align-items: center; text-align: center;max-width:18rem; padding:0px 5px 0px 5px">                                  <div class="card">
            <div class="card-header">Total Working Hours</div>
                <div class="card-body">
                    <p id = "totalWorkingHrs"class="card-text"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col col-sm-4" style="display: flex;justify-content: center; align-items: center;">
        <div class="card text-white bg-primary mb-3" style="display: flex;justify-content: center; align-items: center;text-align: center;max-width:18rem;padding:0px 5px 0px 5px">                                  <div class="card">
            <div class="card-header">Total Hours Spent</div>
                <div class="card-body">
                    <p id = "hrsSpent"class="card-text"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="col col-sm-4" style="display: flex;justify-content: center; align-items: center;">
        <div class="card text-white bg-primary mb-3" style="display: flex;justify-content: center; align-items: center;text-align: center;max-width:18rem; padding:0px 5px 0px 5px">                                  <div class="card">
            <div class="card-header">Total Hours Remaining</div>
                <div class="card-body">
                    <p id = "hrsRemaining"class="card-text"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="display: flex;align-items: center;justify-content: center;">
    
    <div class = "col col-sm-4" style="margin-bottom: 5px">
        <select name="month" id = "month" value = "{{date('m')}}">

        <option value="1" data-days="30">January</option>
        <option value="2" data-days="31">February</option>
        <option value="3" data-days="30">March</option>
        <option value="4" data-days="31">April</option>
        <option value="5" data-days="30">May</option>
        <option value="6" data-days="31">June</option>
        <option value="7" data-days="30">July</option>
        <option value="8" data-days="31">August</option>
        <option value="9" data-days="30">September</option>
        <option value="10" data-days="31">October</option>
        <option value="11" data-days="30">November</option>
        <option value="12" data-days="31">December</option>
        </select>
        <input  type="text" id = "year" name="year" value = "{{date("Y")}}" data-mask="2099"> <button  id="search" onclick="get_history()">search</button>        
    </div>
    <div class="col col-sm-8 text-right" style="">
        <span id="user" data-id="{{$user->id}}">Userid: {{$user->id}} Username: {{$user->name}}</span>
    </div>
</div>


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
                        
                            <table class="table table-bordered" id="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Required Hours</th>
                                        <th>Hours Spent</th>
                                        <th>Hours Remaining</th>
                                    </tr>
                                </thead>
                                <tbody id = "tbody">
                                    {{-- @foreach ($user->history as $history)
                                    <tr>
                                        <td>{{substr($history->time_in, 0, 10)}}</td>
                                        <td>{{substr($history->time_in, 11, 18)}}</td>
                                        <td>{{substr($history->time_out, 10, 18)}}</td>
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
    </div>
            

<div class="modal fade" id="generatePaySlipModal" tabindex="-1" aria-labelledby="generatePaySlipModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="" method="POST" id="generatePaySlipForm">
          @csrf
          @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Generate Pay Slip</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <label for="start">Enter year,month:</label>

            <input type="month" id="month" name="month" min="2018-03"  placeholder="YYYY-MM" />
          
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
    
    document.addEventListener("DOMContentLoaded", (event) => {
    $month = parseInt(document.getElementById("month").value)
    console.log('month ',$month)
    document.getElementById("month").options.selectedIndex = $month -1
        
    });

    function get_history(){
        month = document.getElementById("month").value;
        year = document.getElementById("year").value;
        userId = document.getElementById("user").getAttribute("data-id");

        $.ajax({
            url: "/userHistory/" + userId +"/get",
            type : "POST", 
            data:{"_token": "{{ csrf_token() }}", "id": userId,"month": month, "year": year},
            success: function(result){
                data = result.data;
    
                generate_table(data);
                //calculate_kpis(data)
            },		
            error: function () {
                
            }
            });	
            //history = JSON.parse(history)
            //console.log(typeof history)
        

    }
    function generate_table(data){
        tbody = document.getElementById("tbody")
        tbody.innerHTML = ""
        console.log("in function")
        let history = data.history
        var leaves = data.leaves
        month = document.getElementById("month")
        daysInMonth = parseInt(month.options[month.selectedIndex].getAttribute("data-days"))
        console.log(daysInMonth)
        //history.length
        let timeSpent = 0
        let totalHrsRemaining = 0
        
        for(let i=0;i < history.length;i++){
            r = tbody.insertRow(-1)
            cell1 = r.insertCell(0)
            cell2 = r.insertCell(1)
            cell3 = r.insertCell(2)
            cell4 = r.insertCell(3)
            cell5 = r.insertCell(4)
            cell6 = r.insertCell(5)

            date1 = new Date(history[i].time_in)
            date2 = new Date(history[i].time_out)
            date3 = new Date(history[i].time_in.slice(0,10) +" 09:00:00")
            //console.log(date3)

            hoursSpent = date2 - date1
            timeSpent = timeSpent + hoursSpent
            let ms = hoursSpent % 1000;
            let ss = Math.floor(hoursSpent / 1000) % 60;
            let mm = Math.floor(hoursSpent / 1000 / 60) % 60;
            let hh = Math.floor(hoursSpent / 1000 / 60 / 60);
            hoursSpent = hh + ':' + mm + ':' + ss

            date4 = new Date(history[i].time_in.slice(0,10) + " " + hoursSpent)
            //console.log(date4)
            if(date4> date3){
                hoursRemaining = "00:00:00"
            }
            else{
                hoursRemaining = date3 - date4
                totalHrsRemaining = totalHrsRemaining + hoursRemaining
                console.log(hoursRemaining)
                // ms = hoursRemaining % 1000;
                ss = Math.floor(hoursRemaining / 1000) % 60;
                mm = Math.floor(hoursRemaining / 1000 / 60) % 60;
                hh = Math.floor(hoursRemaining / 1000 / 60 / 60);
                hoursRemaining = hh + ':' + mm + ':' + ss;
            }
            

 
            cell1.innerHTML = history[i].time_in.slice(0,10)
            cell2.innerHTML = history[i].time_in.slice(10,19)
            cell3.innerHTML = history[i].time_out.slice(10,19)
            cell4.innerHTML = "9"
            cell5.innerHTML = hoursSpent
            cell6.innerHTML = hoursRemaining
        }
        
        ms = timeSpent % 1000;
        ss = Math.floor(timeSpent / 1000) % 60;
        mm = Math.floor(timeSpent / 1000 / 60) % 60;
        hh = Math.floor(timeSpent / 1000 / 60 / 60);
        timeSpent = hh + ':' + mm + ':' + ss

        ms = totalHrsRemaining % 1000;
        ss = Math.floor(totalHrsRemaining / 1000) % 60;
        mm = Math.floor(totalHrsRemaining / 1000 / 60) % 60;
        hh = Math.floor(totalHrsRemaining / 1000 / 60 / 60);
        totalHrsRemaining = hh + ':' + mm + ':' + ss
        
        totalLeaveDays = 0
        
        for(let i = 0; i < leaves.length; i++){
            
            let to = daysInMonth
            if(parseInt(leaves[i].from_date.slice(0,4)) == parseInt(leaves[i].to_date.slice(0,4)) ){
                if(parseInt(leaves[i].from_date.slice(5,7)) == parseInt(leaves[i].to_date.slice(5,7))){
                    to = parseInt(leaves[i].to_date.slice(8,10))
                }
            
            }
            
            from = parseInt(leaves[i].from_date.slice(8,10))
            console.log("from:"+from)
            //to = parseInt(leaves[i].to_date.slice(8,10))
            console.log("to:"+to)
            totalLeaveDays = totalLeaveDays + (to - from + 1)
            count = 0
            for(let j = from; j < to+1; j++){
                r = table.insertRow(-1)
                cell1 = r.insertCell(0)
                cell2 = r.insertCell(1)
                cell3 = r.insertCell(2)
                cell4 = r.insertCell(3)
                cell5 = r.insertCell(4)
                cell6 = r.insertCell(5)

                cell1.innerHTML = leaves[i].from_date.slice(0,8) + (parseInt(leaves[i].from_date.slice(8,10)) + count)
                cell2.innerHTML = "leave"
                cell3.innerHTML = "leave"
                cell4.innerHTML = "leave"
                cell5.innerHTML = "leave"
                cell6.innerHTML = "leave"

                count++
            }

        }
        totalWorkingHrs = 9 * daysInMonth - (9 * totalLeaveDays)
        document.getElementById("totalWorkingHrs").innerHTML = totalWorkingHrs
        document.getElementById("hrsSpent").innerHTML = timeSpent
        document.getElementById("hrsRemaining").innerHTML = totalHrsRemaining


    }
</script>
	