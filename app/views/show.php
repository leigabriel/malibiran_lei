<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="min-h-screen bg-[#212631] text-white">

    <!-- Navbar -->
    <nav class="w-full bg-[#2a2f3a] fixed top-0 left-0 border-b border-gray-700 z-50">
        <div class="min-screen mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <!-- Title (Left) -->
            <a href="<?= site_url('/'); ?>" class="text-center sm:text-left text-xl sm:text-2xl font-bold">Users Data Dashboard</a>

            <!-- Search + Buttons (Right) -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                <form action="<?= site_url('users/show'); ?>" method="get" class="flex flex-col sm:flex-row sm:items-center gap-2">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input type="text" name="q" placeholder="Search records..." value="<?= html_escape($q); ?>"
                        class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white w-full sm:w-64">

                    <!-- Search + Clear buttons -->
                    <div class="flex gap-2">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold text-white w-full sm:w-auto">Search</button>

                        <a href="<?= site_url('users/show'); ?>"
                            class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md font-semibold text-white w-full sm:w-auto text-center">Clear</a>
                    </div>
                </form>

                <!-- Create -->
                <a href="<?= site_url('users/create'); ?>"
                    class="px-5 py-2 bg-green-600 hover:bg-green-700 rounded-md font-semibold text-white text-center">
                    + Create New
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="w-full px-4 sm:px-6 pt-36 pb-10">
        <!-- Table -->
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full border border-gray-700 border-collapse bg-[#212631] text-white">
                <thead class="bg-[#1b1f29]">
                    <tr>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">ID</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Last Name</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">First Name</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Email</th>
                        <th class="px-4 py-3 text-left uppercase text-xs sm:text-sm font-semibold">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php
                    $colors = [
                        'bg-red-600',
                        'bg-green-600',
                        'bg-yellow-600',
                        'bg-blue-600',
                        'bg-pink-600',
                        'bg-purple-600',
                        'bg-orange-600',
                        'bg-teal-600'
                    ];
                    $i = 0;
                    foreach (html_escape($users) as $user):
                        $color = $colors[$i % count($colors)];
                    ?>
                        <tr class="hover:bg-[#2a2f3a] transition">
                            <!-- Random Color Badge for ID -->
                            <td class="px-4 py-3 border-r border-gray-700">
                                <span class="px-3 py-1 rounded-md text-white font-bold <?= $color ?>"><?= $user['id']; ?></span>
                            </td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['last_name']; ?></td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['first_name']; ?></td>
                            <td class="px-4 py-3 border-r border-gray-700"><?= $user['email']; ?></td>
                            <td class="px-4 py-3 space-x-3">
                                <a href="<?= site_url('users/update/' . $user['id']); ?>"
                                    class="text-blue-400 hover:text-blue-200 font-medium">Update</a>
                                <a href="<?= site_url('users/delete/' . $user['id']); ?>"
                                    onclick="return confirm('Are you sure you want to delete this record?');"
                                    class="text-red-400 hover:text-red-200 font-medium">Delete</a>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="fixed bottom-4 right-4 sm:bottom-6 sm:right-6 flex flex-wrap justify-end items-center gap-3 bg-white/90 dark:bg-gray-800/80 p-2 rounded-lg shadow-md z-50">
            <?php if (isset($page)) echo $page; ?>
        </div>
    </section>

</body>

</html>