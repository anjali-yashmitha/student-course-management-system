<!DOCTYPE html>
<html>

<head>
    <title>DreamAcademy - Online Learning System</title>
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
            <a href="about.php" class="text-slate-600 hover:text-primary transition-colors">About</a>
            <a href="#" class="text-slate-600 hover:text-primary transition-colors">Courses</a>
            <a href="#" class="text-slate-600 hover:text-primary transition-colors">Team</a>
            <a href="#" class="text-slate-600 hover:text-primary transition-colors">Pricing</a>
            <a href="#" class="text-slate-600 hover:text-primary transition-colors">Contact us</a>
        </div>
        <div class="flex gap-4">
            <a href="login.php"
                class="bg-gradient-to-r from-primary to-secondary text-white px-6 py-2 rounded-lg hover:shadow-lg hover:shadow-indigo-200 transition-all">
                Sign in
            </a>
            <a href="signup.php"
                class="bg-white text-primary border border-primary/20 px-6 py-2 rounded-lg hover:shadow-lg hover:bg-slate-50 transition-all">
                Sign up
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mx-auto px-8 py-16 flex justify-between items-center">
        <div class="max-w-xl">
            <div class="relative">
                <h1 class="text-5xl font-bold text-slate-800 mb-4">
                    Learn on your <br />
                    <span class="relative bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                        schedule
                        <i class="ri-time-line absolute -right-12 top-0 text-accent text-4xl"></i>
                    </span>
                </h1>
            </div>
            <p class="text-gray-600 mb-8 text-lg">Welcome to our Online Learning System, where knowledge meets
                accessibility.</p>

            <!-- Search Bar -->
            <div class="relative mb-8">
                <input type="text" placeholder="What do you want to learn?"
                    class="w-full px-4 py-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary/30 shadow-sm">
                <i class="ri-search-line absolute right-4 top-3 text-primary"></i>
            </div>

            <button
                class="bg-gradient-to-r from-primary to-secondary text-white px-8 py-3 rounded-lg hover:shadow-lg hover:shadow-indigo-200 transition-all">
                Get Started
            </button>

            <!-- Stats Section -->
            <div class="mt-8 flex items-center gap-8">
                <div class="flex items-center gap-2">
                    <div class="flex -space-x-2">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <div
                                class="w-8 h-8 rounded-full bg-gradient-to-r from-accent to-secondary border-2 border-white">
                            </div>
                        <?php endfor; ?>
                    </div>
                    <span class="text-slate-600">20K+ Students</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="ri-star-fill text-yellow-400 text-xl"></i>
                    <span class="text-gray-600">4.8/5 Rating</span>
                </div>
            </div>
        </div>

        <!-- Right Side Images -->
        <div class="relative">
            <div class="grid grid-cols-2 gap-4">
                <div
                    class="bg-gradient-to-br from-primary/10 to-accent/20 rounded-3xl p-4 h-64 w-64 shadow-lg backdrop-blur-sm">
                </div>
                <div
                    class="bg-gradient-to-br from-secondary/10 to-primary/20 rounded-3xl p-4 h-64 w-64 mt-16 shadow-lg backdrop-blur-sm">
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="bg-gradient-to-br from-slate-50 via-white to-indigo-50 py-16">
        <div class="container mx-auto px-8">
            <h2
                class="text-3xl font-bold text-center mb-12 bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent">
                Our Key Features
            </h2>
            <div class="grid grid-cols-3 gap-8">
                <?php
                $features = [
                    ['icon' => 'ri-video-line', 'title' => 'Video Lectures', 'color' => 'from-accent to-secondary'],
                    ['icon' => 'ri-book-open-line', 'title' => 'Virtual Classroom', 'color' => 'from-primary to-accent'],
                    ['icon' => 'ri-team-line', 'title' => 'Group Learning', 'color' => 'from-secondary to-primary']
                ];

                foreach ($features as $feature): ?>
                    <div class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all">
                        <div
                            class="w-12 h-12 rounded-lg bg-gradient-to-r <?php echo $feature['color']; ?> flex items-center justify-center mb-4">
                            <i class="<?php echo $feature['icon']; ?> text-white text-xl"></i>
                        </div>
                        <h3 class="font-bold mb-2 text-gray-800"><?php echo $feature['title']; ?></h3>
                        <p class="text-gray-600">Experience interactive learning with our modern platform</p>
                    </div>
                <?php endforeach; ?>
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