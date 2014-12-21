<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Password Reset</h2>

		<div>
			To reset your password, click this link 
			<a href="<?php echo URL::to('api/reset/' . $token); ?>">Reset password</a>
		</div>
	</body>
</html>
