@extends('layouts.app')

@section('content')

<div class="alert alert-block alert-success">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i>Dashboard</h4>
	<p>
		You are logged in!
	</p>
</div>

<div class="row">
	<article class="col-sm-12 col-md-12 col-lg-12">
		
		<div class="row">

			<article class="col-sm-12 col-md-12 col-lg-6">
				
				<div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
					
					<div>
						
						<div class="widget-body no-padding">
							
							<form id="checkout-form" action = "{{ isset($user) ? route('users.update',$user->id) :  route('register')}}" class="smart-form" method = "POST">
								@csrf
								@if(isset($user))
								@method('PUT')
								@endif
								<header>
									<label id = "date">{{$dateNow}}</label><label id = "role">{{$role}}</label> <label id = "time" style="visibility: hidden">{{$timeNow}}</label><label id = "elapsed">00:00:00</label>
								</header>
								<fieldset>
									<div class="row" style="display: flex;align-items: center;justify-content: center;">
										<section class=""><i class="fa fa-clock-o"></i>
											<span style="font-weight:bold" id="timeIn">{{$timeIn}}</span>
										</section>
										<section class="col col-4">
											
										</section>
										<section class=""><i class="fa fa-clock-o"></i>
											<span style="font-weight:bold"id="timeOut">{{$timeOut}}</span>
										</section>
									</div>
									<div class="row" style="display: flex;align-items: center;justify-content: center;">
										<section class="col col-12">
											<a id = "timeBtn" class="btn btn-default"  onclick="time_in()"><i class="fa fa-clock-o"></i>Time In</a></td>
										</section>
										
									</div>
								</fieldset>
							
							</form>						
							
						</div>

						
					</div>	
				
				</div>
	
	
			</article>
	
		</div>
{{-- 
		<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-5" data-widget-editbutton="false">
			<div>
				<div class="widget-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>Date</th>
									<th>Time In</th>
									<th>Time Out</th>
									
									
								</tr>
							</thead>
							<tbody>

								@foreach ($userHistory as $user)
								<tr>
									<td>{{substr($user->time_in, 0, 10)}}</td>
									<td>{{substr($user->time_in, 11, 18)}}</td>
									<td>{{substr($user->time_out, 10, 18)}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		

		</div> --}}

	</article>
</div>
<div class= row>
	<p>{{$totalHrs}}</p>
</div>

@endsection


<script>

function time_in(){
	document.getElementById("timeBtn").innerHTML = "Time Out";
	document.getElementById("timeBtn").onclick = function(){ time_out();};
	$.ajax({
		url: "/home/timeIn", 
		type : "post", 
		data:{"_token": "{{ csrf_token() }}"},
		success: function(result){
			timeNow = result.data["timeIn"];
			console.log("timenow"+timeNow)
			document.getElementById("timeIn").innerHTML = document.getElementById("timeIn").innerHTML + timeNow

			const timeElapsed = timer(timeNow)
			console.log("before time"+timeElapsed)
			intervalID =  setInterval(time,1000,timeElapsed)
		  },
		error: function () {
			
		}
		});	
}

function time_out(){
	document.getElementById("timeBtn").remove()
	$.ajax({
		url: "/home/timeOut", 
		type : "post", 
		data:{"_token": "{{ csrf_token() }}"},
		success: function(result){
			timeNow = result.data["timeOut"];
			console.log("timenow"+timeNow)
			document.getElementById("timeOut").innerHTML = document.getElementById("timeOut").innerHTML + timeNow
			clearInterval(intervalID)

			//const timeElapsed = timer(timeNow)
			//console.log("before time"+timeElapsed)
			//intervalID =  setInterval(time,1000,timeElapsed)
		  },
		error: function () {
			
		}
		});	
	
}
function time(time){
	console.log("in time"+time)
	tH = parseInt(time[0])
	tM = parseInt(time[1])
	tS = parseInt(time[2])
	if(tS == 59){
		tS = 0
		tM += 1
		if(tM == 60){
			tM = 0
			tH += 1
		}
	}
	else{
		tS+=1
	}
	time[0] = tH
	time[1] = tM
	time[2] = tS

	if (tS < 10){
		tS = "0"+tS
	}
	if(tM < 10){
		tM = "0"+tM
	}
	if(tH<10){
		tH = "0"+tH
	}
	document.getElementById("elapsed").innerHTML = tH+":"+tM+":"+tS
	
}

var intervalID	
document.addEventListener("DOMContentLoaded", (event) => {
		if(document.getElementById("timeIn").innerHTML != "Time in: "){
			console.log("time in here");
			document.getElementById("timeBtn").innerHTML = "Time Out";

			if(document.getElementById("timeOut").innerHTML == "Time out: "){
				document.getElementById("timeBtn").onclick = function(){ time_out();};
				let timeNow = document.getElementById("time").innerHTML
				const timeElapsed = timer(timeNow)
				console.log("before time"+timeElapsed)
				intervalID =  setInterval(time,1000,timeElapsed)
			}
			else{
				
				document.getElementById("timeBtn").remove()

				$timeOut = document.getElementById("timeOut").innerHTML.slice(10);
				$timeOut = timer($timeOut)

				if ($timeOut[0] < 10){
					document.getElementById("elapsed").innerHTML = "0"+$timeOut[0]+":"
				}
				else{
					document.getElementById("elapsed").innerHTML = $timeOut[0]+":"
				}
				if ($timeOut[1] < 10){
					document.getElementById("elapsed").innerHTML+= "0"+$timeOut[1]+":"
				}
				else{
					document.getElementById("elapsed").innerHTML+= $timeOut[1]+":"
				}
				if ($timeOut[2] < 10){
					document.getElementById("elapsed").innerHTML += "0"+$timeOut[2]
				}
				else{
					document.getElementById("elapsed").innerHTML += $timeOut[2]
				}

				//document.getElementById("elapsed").innerHTML = $timeOut[0] + ":" + $timeOut[1] + ":" + $timeOut[2]
				//$timeOut = document.getElementById("timeOut").innerHTML
				//document.getElementById("timeInBtn").innerHTML = timer($time_out)
			}
		}
		// else{
		// 	document.getElementById("timeOutBtn").className = "";
		// 		document.getElementById("timeOutBtn").onclick = "";
		// }

	});


function timer(currentTime){
	console.log("here2")
	//time_now()
	let timeNow = currentTime
	//let timeNow = document.getElementById("time").innerHTML
	console.log("timeNow"+timeNow)
	let timeIn = document.getElementById("timeIn").innerHTML.slice(9)
	console.log("timeIn"+timeIn)
	let hN = parseInt(timeNow.slice(0,2))
	console.log(hN)
	let hI = parseInt(timeIn.slice(0,2))
	console.log(hI)

	let mN = parseInt(timeNow.slice(3,5))
	console.log(mN)

	let mI = parseInt(timeIn.slice(3,5))
	console.log(mI)

	let sN = parseInt(timeNow.slice(6,8))
	console.log(sN)

	let sI = parseInt(timeIn.slice(6,8))

	let tM = mN - mI
	let tH = hN - hI
	let tS = sN - sI
	console.log("ts:"+tS)
	if(tS<0){
		tS = 60 - sI + sN
		mN--
	}
	console.log("ts:"+tS)

	if(tM<0){
		tM = 60 - mI + mN
		tH--
	}
	
	const time = [tH, tM, tS]
	console.log(time)
		return time
	
}
</script>

