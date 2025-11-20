<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found - DreamAcademy</title>
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
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes pulse-ring {
            0% {
                transform: scale(0.7);
                opacity: 0.3;
            }

            50% {
                transform: scale(1);
                opacity: 0.8;
            }

            100% {
                transform: scale(0.7);
                opacity: 0.3;
            }
        }

        .animate-pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
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

    <div class="container mx-auto px-4 min-h-[80vh] flex items-center justify-center">
        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 shadow-xl text-center max-w-lg">
            <div class="relative mb-8">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-primary to-secondary rounded-full animate-pulse-ring">
                </div>
                <h1
                    class="text-8xl font-bold bg-gradient-to-r from-primary to-secondary bg-clip-text text-transparent animate-float">
                    404
                </h1>
            </div>

            <p class="text-slate-600 text-xl mb-8">
                Oops! The page you are looking for might be in another dimension.
            </p>

            <div class="space-y-6">
                <div class="flex justify-center">
                    <i class="ri-ghost-line text-6xl text-primary/80 animate-float"></i>
                </div>

                <a href="index.php"
                    class="inline-flex items-center px-6 py-3 rounded-lg bg-gradient-to-r from-primary to-secondary text-white hover:shadow-lg hover:shadow-indigo-200 transition-all">
                    <i class="ri-home-heart-line mr-2"></i>
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-200 py-8">
        <div class="container mx-auto px-8 text-center">
            <p>DreamAcademy &copy; 2024</p>
        </div>
    </footer>
</body>

</html>