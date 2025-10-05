<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en" class="h-full bg-[#212631] text-[#ebebeb]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center px-4">

    <!-- Intro Section -->
    <div class="text-center space-y-6 max-w-xl">
        <h1 class="text-6xl font-bold">User Management</h1>
        <p class="text-xl text-gray-300">
            Manage your users quickly and securely using <span class="bg-orange-700 font-bold italic rounded-xl px-2">LavaLust Framework.</span>

        </p>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <!-- View Users -->
            <a href="<?= site_url('login'); ?>"
                class="px-6 py-3 border-1 border-green-500 text-green-500 font-semibold rounded-xl transition hover:bg-green-500 hover:text-white">
                View Users
            </a>

            <!-- Add User -->
            <a href="<?= site_url('login'); ?>"
                class="px-6 py-3 border-1 border-blue-500 text-blue-500 font-semibold rounded-xl transition hover:bg-blue-500 hover:text-white">
                Add User
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-16 text-center text-xs text-gray-500">
        Page rendered in <strong><?php echo lava_instance()->performance->elapsed_time('lavalust'); ?></strong> seconds.
        Memory usage: <?php echo lava_instance()->performance->memory_usage(); ?>.
        <?php if (config_item('ENVIRONMENT') === 'development'): ?>
            <br>LavaLust Version <strong><?php echo config_item('VERSION'); ?></strong>
        <?php endif; ?>
    </footer>

</body>

</html>