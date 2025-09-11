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

    <!-- Home Section -->
    <section
        class="min-h-screen flex flex-col justify-center items-center text-center px-6 sm:px-12 bg-white rounded-b-3xl text-black relative">

        <!-- Main Heading -->
        <h1 class="font-extrabold uppercase leading-snug tracking-tight text-4xl sm:text-6xl md:text-7xl max-w-3xl sm:max-w-5xl lg:max-w-7xl">
            Student Management System
        </h1>

        <!-- Subtext -->
        <p class="mt-4 sm:mt-6 text-lg sm:text-xl md:text-2xl max-w-md sm:max-w-3xl md:max-w-5xl font-medium text-gray-700">
            Effortlessly track, update, and manage all student information in one place.
        </p>

        <!-- Call-to-Action Links -->
        <div class="mt-6 sm:mt-8 flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
            <a href="<?= site_url('students/index'); ?>"
                class="px-6 py-3 bg-blue-600 text-white rounded-full font-semibold text-sm sm:text-base hover:bg-blue-700 transition">
                Manage Students
            </a>
            <a href="<?= site_url('students/create'); ?>"
                class="px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-full font-semibold text-sm sm:text-base hover:bg-blue-50 transition">
                Add New Student
            </a>
        </div>

    </section>

</body>

</html>