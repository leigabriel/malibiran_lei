<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }

        /* Full-screen loading overlay */
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        /* Spinner animation */
        .spinner {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="bg-[#212631] text-white">

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="flex">
        <div class="spinner"></div>
    </div>

    <section
        class="min-h-screen flex flex-col justify-center items-center text-center px-6 sm:px-12 bg-[#2a2f3e] rounded-b-3xl relative shadow-lg">

        <h1 data-aos="fade-down"
            class="font-extrabold uppercase leading-snug tracking-tight text-4xl sm:text-6xl md:text-7xl max-w-3xl sm:max-w-5xl lg:max-w-7xl">
            User Management
        </h1>

        <p data-aos="fade-up"
            class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl max-w-md sm:max-w-3xl md:max-w-5xl font-medium text-gray-300">
            Effortlessly view, add, and manage all user information in one place.
        </p>

        <div data-aos="zoom-in" class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <a href="<?= site_url('users/show'); ?>"
                onclick="showLoading(event)"
                data-aos="fade-right"
                class="px-6 py-3 bg-[#64b5f6] text-[#212631] rounded-full font-semibold text-sm sm:text-base transition text-center">
                View Users
            </a>
            <a href="<?= site_url('users/create'); ?>"
                onclick="showLoading(event)"
                data-aos="fade-left"
                class="px-6 py-3 border-2 border-[#64b5f6] text-[#64b5f6] rounded-full font-semibold text-sm sm:text-base transition text-center">
                Add New User
            </a>
        </div>

        <!-- Footer -->
        <footer data-aos="fade-up" class="text-center text-gray-400 text-sm py-4 mt-6">
            Page rendered in <strong><?php echo lava_instance()->performance->elapsed_time('lavalust'); ?></strong> seconds.
            Memory usage: <?php echo lava_instance()->performance->memory_usage(); ?>.
            <?php if (config_item('ENVIRONMENT') === 'development'): ?>
                <br>LavaLust Version <strong><?php echo config_item('VERSION'); ?></strong>
            <?php endif; ?>
        </footer>
    </section>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800, // animation duration
            once: false // animate only once
        });

        function showLoading(event) {
            event.preventDefault(); // Stop default link navigation
            const url = event.currentTarget.href;

            // Show overlay
            document.getElementById('loadingOverlay').style.display = 'flex';

            // Redirect after a tiny delay to allow overlay to render
            setTimeout(() => {
                window.location.href = url;
            }, 1000);
        }
    </script>

</body>

</html>