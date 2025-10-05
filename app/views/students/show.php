<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="min-h-screen bg-[#212631] text-white">

    <!-- Navbar -->
    <nav class="w-full bg-[#2a2f3a] fixed top-0 left-0 border-b border-gray-700 z-50">
        <div
            class="max-w-screen-xxl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <!-- Title -->
            <h1 class="text-center sm:text-left text-lg sm:text-2xl font-bold whitespace-nowrap">
                User Data List
            </h1>

            <!-- Right Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 w-full sm:w-auto">

                <!-- Search Form -->
                <form action="<?= site_url('users/show'); ?>" method="get"
                    class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                    <?php $q = isset($_GET['q']) ? $_GET['q'] : ''; ?>
                    <input type="text" name="q" placeholder="Search for a records..." value="<?= html_escape($q); ?>"
                        class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white w-full sm:w-64">

                    <div class="flex gap-2 justify-center sm:justify-start">
                        <!-- Search -->
                        <div class="relative group">
                            <button type="submit"
                                class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center transition hover:bg-blue-700">
                                <img src="https://cdn-icons-png.flaticon.com/128/10947/10947920.png" alt="Search" class="w-6 h-6">
                            </button>
                            <!-- Tooltip -->
                            <span
                                class="absolute left-1/2 transform -translate-x-1/2 mt-2 px-2 py-1 text-xs rounded bg-gray-800 text-white opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                Search
                            </span>
                        </div>

                        <!-- Clear -->
                        <div class="relative group">
                            <a href="<?= site_url('users/show'); ?>"
                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center transition hover:bg-gray-300">
                                <img src="https://cdn-icons-png.flaticon.com/128/5249/5249162.png" alt="Clear" class="w-6 h-6">
                            </a>
                            <!-- Tooltip -->
                            <span
                                class="absolute left-1/2 transform -translate-x-1/2 mt-2 px-2 py-1 text-xs rounded bg-gray-800 text-white opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                                Clear
                            </span>
                        </div>
                    </div>
                </form>

                <!-- Create Button (Admin Only) -->
                <?php
                $current_role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
                if ($current_role === 'admin'):
                ?>
                    <div class="relative group">
                        <a href="<?= site_url('users/create'); ?>"
                            class="w-10 h-10 bg-white rounded-full flex items-center justify-center transition hover:bg-gray-400"
                            onclick="showLoading(event)">
                            <img src="https://cdn-icons-png.flaticon.com/128/8377/8377219.png" alt="Create" class="w-6 h-6">
                        </a>
                        <!-- Tooltip -->
                        <span
                            class="absolute left-1/2 transform -translate-x-1/2 mt-2 px-2 py-1 text-xs rounded bg-gray-800 text-white opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap">
                            Create
                        </span>
                    </div>
                <?php endif; ?>

                <!-- Logout -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="relative">
                        <form action="<?= site_url('logout'); ?>" method="post" id="logoutForm" class="flex justify-center sm:justify-end">
                            <button type="button"
                                id="logoutBtn"
                                class="px-5 py-2 bg-red-600 rounded-md hover:bg-red-700 transition font-semibold text-white w-full sm:w-auto">
                                Logout
                            </button>
                        </form>
                    </div>

                    <!-- Logout Confirmation Modal -->
                    <div id="logoutModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                        <div class="bg-[#2a2f3a] p-6 rounded-lg w-80">
                            <h2 class="text-lg font-bold mb-4 text-center">Confirm Logout</h2>
                            <p class="mb-6 text-center">Are you sure you want to logout?</p>
                            <div class="flex justify-center gap-4">
                                <button id="confirmLogoutBtn"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md font-semibold">
                                    Yes
                                </button>
                                <button id="cancelLogoutBtn"
                                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md font-semibold">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section class="w-full px-3 sm:px-6 pt-32 sm:pt-32 pb-10">
        <div class="overflow-x-auto rounded-lg shadow-xl shadow-gray-700/30">
            <table class="min-w-full border border-gray-700 border-collapse bg-[#212631] text-white text-sm sm:text-base">
                <thead class="bg-[#1b1f29]">
                    <tr>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">ID</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Last Name</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">First Name</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Email</th>
                        <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold border-r border-gray-700">Status</th>
                        <?php if ($current_role === 'admin'): ?>
                            <th class="px-3 sm:px-4 py-2 sm:py-3 text-left uppercase text-xs sm:text-sm font-semibold">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    <?php
                    $colors = ['bg-red-600', 'bg-green-600', 'bg-yellow-600', 'bg-blue-600', 'bg-pink-600', 'bg-purple-600', 'bg-orange-600', 'bg-teal-600'];
                    $i = 0;
                    foreach (html_escape($users) as $user):
                        $color = $colors[$i % count($colors)];
                    ?>
                        <tr class="hover:bg-[#2a2f3a] transition">
                            <td class="px-3 sm:px-4 py-2 sm:py-3 border-r border-gray-700">
                                <span class="px-3 py-1 rounded-md text-white font-bold <?= $color ?>">
                                    <?= sprintf("%02d", $user['id']); ?>
                                </span>
                            </td>
                            <td class="px-3 sm:px-4 py-2 sm:py-3 border-r border-gray-700"><?= $user['last_name']; ?></td>
                            <td class="px-3 sm:px-4 py-2 sm:py-3 border-r border-gray-700"><?= $user['first_name']; ?></td>
                            <td class="px-3 sm:px-4 py-2 sm:py-3 border-r border-gray-700 break-all"><?= $user['email']; ?></td>
                            <td class="px-3 sm:px-4 py-2 sm:py-3 border-r border-gray-700">
                                <?php if (!empty($user['status'])): ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    <?= $user['status'] === 'Active' ? 'bg-green-600' : ($user['status'] === 'Inactive' ? 'bg-red-600' : 'bg-gray-600'); ?>">
                                        <?= html_escape($user['status']); ?>
                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-gray-500">
                                        Unknown
                                    </span>
                                <?php endif; ?>
                            </td>
                            <?php if ($current_role === 'admin'): ?>
                                <td class="px-3 sm:px-4 py-2 sm:py-3">
                                    <div class="flex gap-3 justify-center sm:justify-start">
                                        <a href="<?= site_url('users/update/' . $user['id']); ?>"
                                            onclick="showLoading(event)"
                                            class="w-9 h-9 bg-blue-500 rounded-full flex items-center justify-center transition hover:bg-blue-600">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828911.png" alt="Edit" class="w-4 h-4">
                                        </a>

                                        <!-- Delete Button -->
                                        <button type="button"
                                            class="w-9 h-9 bg-red-500 rounded-full flex items-center justify-center transition hover:bg-red-600 delete-btn"
                                            data-delete-url="<?= site_url('users/delete/' . $user['id']); ?>">
                                            <img src="https://cdn-icons-png.flaticon.com/512/1214/1214428.png" alt="Delete" class="w-4 h-4">
                                        </button>
                                        <!-- Delete Confirmation Modal -->
                                        <div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
                                            <div class="bg-[#2a2f3a] p-6 rounded-lg w-80 text-white">
                                                <h2 class="text-lg font-bold mb-4 text-center">Confirm Deletion</h2>
                                                <p class="mb-6 text-center">Are you sure you want to delete this record?</p>
                                                <div class="flex justify-center gap-4">
                                                    <a id="confirmDeleteBtn"
                                                        class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-md font-semibold text-white">
                                                        Yes, Delete
                                                    </a>
                                                    <button id="cancelDeleteBtn"
                                                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md font-semibold">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="fixed bottom-4 right-4 flex flex-wrap gap-2 z-50"> <?php if (isset($page)) echo $page; ?> </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const logoutBtn = document.getElementById("logoutBtn");
            const logoutModal = document.getElementById("logoutModal");
            const cancelLogoutBtn = document.getElementById("cancelLogoutBtn");
            const confirmLogoutBtn = document.getElementById("confirmLogoutBtn");
            const logoutForm = document.getElementById("logoutForm");

            logoutBtn?.addEventListener("click", function() {
                logoutModal.classList.remove("hidden");
            });

            cancelLogoutBtn?.addEventListener("click", function() {
                logoutModal.classList.add("hidden");
            });

            confirmLogoutBtn?.addEventListener("click", function() {
                logoutForm.submit();
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const deleteBtns = document.querySelectorAll(".delete-btn");
            const deleteModal = document.getElementById("deleteModal");
            const cancelDeleteBtn = document.getElementById("cancelDeleteBtn");
            const confirmDeleteBtn = document.getElementById("confirmDeleteBtn");

            let deleteUrl = "";

            deleteBtns.forEach(btn => {
                btn.addEventListener("click", function() {
                    deleteUrl = this.getAttribute("data-delete-url");
                    deleteModal.classList.remove("hidden");
                });
            });

            cancelDeleteBtn.addEventListener("click", function() {
                deleteModal.classList.add("hidden");
            });

            confirmDeleteBtn.addEventListener("click", function() {
                window.location.href = deleteUrl;
            });
        });
    </script>

</body>

</html>