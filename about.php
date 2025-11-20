<!DOCTYPE html>
<html>

<head>
	<title>About - DreamAcademy</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
	<link rel="icon" type="image/x-icon" href="favicon.ico">
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
		<div class="text-2xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
			DreamAcademy
		</div>
		<div class="flex gap-8">
			<a href="index.php" class="text-slate-600 hover:text-primary transition-colors">Home</a>
			<a href="about.php" class="text-primary">About</a>
			<a href="signup.php" class="text-slate-600 hover:text-primary transition-colors">Sign Up</a>
			<a href="login.php" class="text-slate-600 hover:text-primary transition-colors">Login</a>
		</div>
	</nav>

	<!-- Hero Section -->
	<div class="container mx-auto px-8 py-16">
		<div class="text-center mb-16">
			<img src="assets/img/Logo.png" alt="Logo" class="h-20 mx-auto mb-4">
			<h1
				class="text-4xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent mb-4">
				About DreamAcademy
			</h1>
			<p class="text-slate-600 max-w-2xl mx-auto">
				The online learning system website aims to provide a user-friendly and accessible platform for learners,
				instructors, and administrators.
			</p>
		</div>

		<!-- Goals Section -->
		<div class="max-w-4xl mx-auto">
			<div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl">
				<h2 class="text-2xl font-bold text-slate-800 mb-6">Our Goals</h2>
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
					<?php
					$goals = [
						['icon' => 'ri-compass-line', 'text' => 'Enable users to easily navigate and explore available courses'],
						['icon' => 'ri-flow-chart', 'text' => 'Streamline the course enrollment process'],
						['icon' => 'ri-dashboard-line', 'text' => 'Provide an intuitive dashboard for tracking progress'],
						['icon' => 'ri-responsive-line', 'text' => 'Implement responsive design for optimal experience'],
						['icon' => 'ri-discuss-line', 'text' => 'Foster engagement through discussion forums'],
						['icon' => 'ri-tools-line', 'text' => 'Offer instructors intuitive content management'],
						['icon' => 'ri-quiz-line', 'text' => 'Provide tools for quiz and assignment creation'],
						['icon' => 'ri-line-chart-line', 'text' => 'Enable progress tracking and analysis'],
						['icon' => 'ri-medal-line', 'text' => 'Facilitate certificate generation'],
						['icon' => 'ri-team-line', 'text' => 'Support effective communication']
					];

					foreach ($goals as $goal): ?>
						<div class="flex items-start space-x-3 p-4 rounded-lg hover:bg-slate-50 transition-all">
							<i class="<?= $goal['icon'] ?> text-primary text-xl mt-1"></i>
							<p class="text-slate-600"><?= $goal['text'] ?></p>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<footer class="bg-slate-900 text-slate-200 py-8">
		<div class="container mx-auto px-8 text-center">
			<p>DreamAcademy &copy; 2024</p>
		</div>
	</footer>

	<script src="assets/js/jquery-3.5.1.min.js"></script>
</body>

</html>