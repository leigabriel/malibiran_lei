<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body {
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>

<body class="bg-gray-100">

    <section
        class="min-h-screen flex flex-col justify-center items-center text-center px-6 sm:px-12 bg-white rounded-b-3xl text-black relative">

        <h1
            class="font-extrabold uppercase leading-snug tracking-tight text-4xl sm:text-6xl md:text-7xl max-w-3xl sm:max-w-5xl lg:max-w-7xl">
            Student Management System
        </h1>

        <p
            class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl max-w-md sm:max-w-3xl md:max-w-5xl font-medium text-gray-700">
            Effortlessly track, update, and manage all student information in one place.
        </p>

        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <button onclick="openLogin('<?= site_url('students/index'); ?>')"
                class="px-6 py-3 bg-blue-600 text-white rounded-full font-semibold text-sm sm:text-base hover:bg-blue-700 transition">
                Manage Students
            </button>
            <button onclick="openLogin('<?= site_url('students/create'); ?>')"
                class="px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-full font-semibold text-sm sm:text-base hover:bg-blue-50 transition">
                Add New Student
            </button>
        </div>
    </section>

    <div id="loginModal"
        class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 p-4">
        <div
            class="bg-white rounded-xl shadow-lg w-full max-w-sm p-6 relative border border-gray-200">

            <h2 class="text-lg font-semibold text-center text-blue-700 mb-6">
                Login
            </h2>

            <form onsubmit="return handleLogin(event)" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm text-gray-600 mb-1">Username</label>
                    <input type="text" id="username"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                        placeholder="username" required>
                </div>
                <div>
                    <label for="password" class="block text-sm text-gray-600 mb-1">Password</label>
                    <input type="password" id="password"
                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 text-sm"
                        placeholder="password" required>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-medium">
                    Login
                </button>
                <button type="button" onclick="closeLogin()"
                    class="w-full mt-2 bg-gray-100 text-gray-700 py-2 rounded-lg hover:bg-gray-200 transition text-sm">
                    Cancel
                </button>
            </form>
        </div>
    </div>

    <script>
        let redirectUrl = "";

        function openLogin(url) {
            redirectUrl = url;
            document.getElementById("loginModal").classList.remove("hidden");
        }

        function closeLogin() {
            document.getElementById("loginModal").classList.add("hidden");
        }

        function handleLogin(event) {
            event.preventDefault();
            const username = document.getElementById("username").value;
            const password = document.getElementById("password").value;

            if (username === "admin" && password === "1234") {
                window.location.href = redirectUrl;
            } else {
                alert("Invalid credentials. Try admin / 1234");
            }
        }
    </script>

</body>

</html>