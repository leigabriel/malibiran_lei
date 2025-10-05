<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'JetBrains Mono', monospace;
        }
    </style>
</head>

<body class="min-h-screen bg-[#212631] text-white flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-[#2a2f3a] rounded-lg shadow-lg p-6">
        <!-- Title -->
        <h1 class="text-2xl font-bold mb-6 text-center">Update User</h1>

        <!-- Form -->
        <form action="<?= site_url('users/update/' . $user['id']); ?>" method="post" class="space-y-4">
            <!-- Last Name -->
            <div class="flex flex-col">
                <label for="last_name" class="mb-1 font-semibold">Last Name</label>
                <input type="text" id="last_name" name="last_name" required
                    value="<?= html_escape($user['last_name']); ?>"
                    class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- First Name -->
            <div class="flex flex-col">
                <label for="first_name" class="mb-1 font-semibold">First Name</label>
                <input type="text" id="first_name" name="first_name" required
                    value="<?= html_escape($user['first_name']); ?>"
                    class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Email -->
            <div class="flex flex-col">
                <label for="email" class="mb-1 font-semibold">Email</label>
                <input type="email" id="email" name="email" required
                    value="<?= html_escape($user['email']); ?>"
                    class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Status -->
            <div>
                <label for="status">Status</label><br>
                <select id="status" name="status" class="px-3 py-2 rounded-md bg-[#212631] border border-gray-600 text-white w-full">
                    <option value="Active" <?= $user['status'] === "Active" ? "selected" : ""; ?>>Active</option>
                    <option value="Inactive" <?= $user['status'] === "Inactive" ? "selected" : ""; ?>>Inactive</option>
                    <option value="Unknown" <?= $user['status'] === "Unknown" ? "selected" : ""; ?>>Unknown</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-6">
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-md font-semibold transition">
                    Update
                </button>

                <a href="<?= site_url('users/show'); ?>"
                    class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-md font-semibold text-center transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</body>

</html>