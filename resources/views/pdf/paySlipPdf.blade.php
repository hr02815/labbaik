<!DOCTYPE html>
<html>
<head>
    <title>Pay Slip</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <br/>
    <br/>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>
            
        </tbody>
    </table>
    <div>
        <p>
            Daily office hours: {{$dailyWorkingHours}} <br>
            Number of days off in the month: {{$holidays}} <br>
            Number of paid leaves: {{$paidLeaves}} <br>
            Number of working hours in the month:{{$monthHrs}} <br>
            Number of Hours worked: {{$hrsWorked}} <br>
            Monthly salary: {{$user->salary}} <br>
            Salary after adjustment: {{$pay}}
        </p>
    </div>

</body>
</html>