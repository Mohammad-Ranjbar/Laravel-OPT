<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP verify</title>
</head>
<body>
<form action="{{route('verify')}}" method="post" role="form">
    @csrf
    <legend>OTP</legend>

    <div class="form-group">
        <label for="otp">otp</label>
        <input type="text" class="form-control" name="otp" id="otp" placeholder="Input...">
    </div>



    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</body>
</html>
