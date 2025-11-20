<?php
include "Utils/Validation.php";


$fname = $uname = $email = $bd = $lname = "";
if (isset($_GET["fname"])) {
	$fname = Validation::clean($_GET["fname"]);
}
if (isset($_GET["uname"])) {
	$uname = Validation::clean($_GET["uname"]);
}
if (isset($_GET["email"])) {
	$email = Validation::clean($_GET["email"]);
}
if (isset($_GET["bd"])) {
	$bd = Validation::clean($_GET["bd"]);
}
if (isset($_GET["lname"])) {
	$lname = Validation::clean($_GET["lname"]);
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up - DreamAcademy</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						primary: '#4F46E5',
						secondary: '#0EA5E9',
						accent: '#818CF8'
					}
				}
			}
		}
	</script>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
	<!-- Navigation -->
	<nav class="flex justify-between items-center px-8 py-4 bg-white/80 backdrop-blur-md shadow-sm">
		<a href="index.php"
			class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
			DreamAcademy
		</a>
		<a href="index.php" class="text-slate-600 hover:text-primary transition-colors">
			<i class="ri-home-line mr-2"></i>Back to Home
		</a>
	</nav>

	<div class="container mx-auto px-4 py-16">
		<div class="max-w-2xl mx-auto">
			<div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl">
				<div class="text-center mb-8">
					<img src="assets/img/Logo.png" alt="Logo" class="h-16 mx-auto mb-4">
					<h2
						class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
						Create New Student Account
					</h2>
				</div>

				<?php if (isset($_GET['error'])) { ?>
					<div class="bg-red-50 text-red-500 rounded-lg p-4 mb-6">
						<?= Validation::clean($_GET['error']) ?>
					</div>
				<?php } ?>
				<?php if (isset($_GET['success'])) { ?>
					<div class="bg-green-50 text-green-500 rounded-lg p-4 mb-6">
						<?= Validation::clean($_GET['success']) ?>
					</div>
				<?php } ?>

				<form action="Action/signup.php" method="POST" class="space-y-6">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-user-line mr-2"></i>First Name
							</label>
							<input type="text" name="fname" value="<?= $fname ?>"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Enter first name">
						</div>
						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-user-line mr-2"></i>Last Name
							</label>
							<input type="text" name="lname" value="<?= $lname ?>"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Enter last name">
						</div>
					</div>

					<div>
						<label class="text-slate-600 mb-2 block">
							<i class="ri-mail-line mr-2"></i>Email
						</label>
						<input type="email" name="email" value="<?= $email ?>"
							class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
							placeholder="Enter email">
					</div>

					<div>
						<label class="text-slate-600 mb-2 block">
							<i class="ri-calendar-line mr-2"></i>Birth Date
						</label>
						<input type="date" name="date_of_birth" value="<?= $bd ?>"
							class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm">
					</div>

					<div>
						<label class="text-slate-600 mb-2 block">
							<i class="ri-user-3-line mr-2"></i>Username
						</label>
						<input type="text" name="username" value="<?= $uname ?>"
							class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
							placeholder="Choose username">
					</div>

					<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-lock-line mr-2"></i>Password
							</label>
							<input type="password" name="password"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Create password">
						</div>
						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-lock-line mr-2"></i>Confirm Password
							</label>
							<input type="password" name="re_password"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Confirm password">
						</div>
					</div>

					<button type="submit"
						class="w-full bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-lg hover:shadow-lg hover:shadow-indigo-200 transition-all">
						<i class="ri-user-add-line mr-2"></i>Create Account
					</button>

					<div class="text-center text-slate-600">
						<p>Already have an account?
							<a href="login.php" class="text-primary hover:text-secondary transition-colors">Sign In</a>
						</p>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>