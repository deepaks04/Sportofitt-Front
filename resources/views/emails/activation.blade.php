<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8">
</head>
<body>


	<p>Welcome to Sportofit! {{$fname}} {{$lname}}, You are almost there.
		Just click the link below to confirm your email address.</p>
	<p></p>
	<a href='{{{ URL::to("api/v1/user/confirm/$remember_token") }}}'> <span
		style="color: blue; font-weight: 900">Click on this, to confirm your
			account!!</span>
	</a>
	</p>
	<p>
		Stay Fit,<br> The team at Spotofit
	</p>
	<p>Thank you</p>

</body>
</html>