<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="bg-[#212631] text-white">

    <section
        class="min-h-screen flex flex-col justify-center items-center text-center px-6 sm:px-12 bg-[#2a2f3e] rounded-b-3xl relative shadow-lg">

        <h1
            class="font-extrabold uppercase leading-snug tracking-tight text-4xl sm:text-6xl md:text-7xl max-w-3xl sm:max-w-5xl lg:max-w-7xl">
            User Data Management
        </h1>

        <p
            class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl max-w-md sm:max-w-3xl md:max-w-5xl font-medium text-gray-300">
            Effortlessly view, add, and manage all user information in one place.
        </p>

        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <a href="<?= site_url('users/show'); ?>"
                class="px-6 py-3 bg-[#64b5f6] text-[#212631] rounded-full font-semibold text-sm sm:text-base hover:bg-[#42a5f5] transition text-center">
                View Users
            </a>
            <a href="<?= site_url('users/create'); ?>"
                class="px-6 py-3 border-2 border-[#64b5f6] text-[#64b5f6] rounded-full font-semibold text-sm sm:text-base hover:bg-[#42b0f5]/20 transition text-center">
                Add New User
            </a>
        </div>
        <!-- Footer -->
        <footer class="text-center text-gray-400 text-sm py-4 mt-6">
            Page rendered in <strong><?php echo lava_instance()->performance->elapsed_time('lavalust'); ?></strong> seconds.
            Memory usage: <?php echo lava_instance()->performance->memory_usage(); ?>.
            <?php if (config_item('ENVIRONMENT') === 'development'): ?>
                <br>LavaLust Version <strong><?php echo config_item('VERSION'); ?></strong>
            <?php endif; ?>
        </footer>
    </section>

</body>

</html>