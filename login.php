<?php
include "Utils/Validation.php";
include "Config.php";
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login - <?= SITE_NAME ?></title>
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
		<div class="max-w-md mx-auto">
			<div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl">
				<div class="text-center mb-8">
					<img src="assets/img/Logo.png" alt="Logo" class="h-16 mx-auto mb-4">
					<h2
						class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
						Welcome Back!
					</h2>
				</div>

				<?php if (isset($_GET['error'])) { ?>
					<div class="bg-red-50 text-red-500 rounded-lg p-4 mb-6">
						<?= Validation::clean($_GET['error']) ?>
					</div>
				<?php } ?>

				<form action="Action/login.php" method="POST">
					<div class="space-y-6">
						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-user-line mr-2"></i>Username
							</label>
							<input type="text" name="username"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Enter username">
						</div>

						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-lock-line mr-2"></i>Password
							</label>
							<input type="password" name="password"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm"
								placeholder="Enter password">
						</div>

						<div>
							<label class="text-slate-600 mb-2 block">
								<i class="ri-user-settings-line mr-2"></i>Role
							</label>
							<select name="role"
								class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm">
								<option value="Admin">Admin</option>
								<option value="Instructor">Instructor</option>
								<option value="Student">Student</option>
							</select>
						</div>

						<button type="submit"
							class="w-full bg-gradient-to-r from-primary to-secondary text-white px-6 py-3 rounded-lg hover:shadow-lg hover:shadow-indigo-200 transition-all">
							<i class="ri-login-circle-line mr-2"></i>Login
						</button>

						<div class="text-center text-slate-600">
							<p>Don't have an account?
								<a href="signup.php" class="text-primary hover:text-secondary transition-colors">
									Create One
								</a>
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="assets/js/jquery-3.5.1.min.js"></script>
</body>

</html>