<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- ... (le reste du head reste inchangé) ... -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Plateforme Éducative</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="background-image flex items-center justify-center min-h-screen">
    <div class="bg-blue-600 bg-opacity-75 p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <i class="fas fa-graduation-cap text-white text-5xl mb-4"></i>
        </div>
        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline"><?php echo $error; ?></span>
            </div>
        <?php endif; ?>
        <form method="POST" action="/login">
            <div class="mb-4">
                <input type="text" placeholder="USERNAME" name="login" class="w-full px-4 py-2 rounded-md bg-blue-500 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <div class="mb-6">
                <input type="password" placeholder="PASSWORD" name="password" class="w-full px-4 py-2 rounded-md bg-blue-500 text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
            <button type="submit" class="w-full bg-white text-blue-600 font-bold py-2 px-4 rounded-md hover:bg-blue-100 transition duration-300">LOGIN</button>
        </form>
        <div class="text-center mt-4">
            <a href="#" class="text-white text-sm hover:underline">Forgot password?</a>
        </div>
    </div>
</body>
</html>
