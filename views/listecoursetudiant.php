<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue d'ensemble des cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <div class="flex items-center">
                <img src="logo.png" alt="Logo" class="h-8 w-8">
                <h1 class="text-xl font-bold ml-2">ETUDIANT: ELIMANE GNING</h1>
            </div>
            <nav>
                <ul class="flex space-x-4">
                    <li><a href="#" class="text-black font-semibold">ACCUEIL</a></li>
                    <li><a href="#" class="text-black font-semibold">SESSIONS</a></li>
                    <li><a href="#" class="text-black font-semibold">ABSENT</a></li>
                    <li><a href="#" class="text-black font-semibold">MES COURS</a></li>
                    <li><a href="#" class="text-black font-semibold">DECONNEXION</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-6">
        <div class="bg-gray-200 p-4 rounded-lg mb-6">
            <div class="flex justify-between items-center">
                <div>
                    <label for="filter" class="block text-sm font-medium text-gray-700">Filtrer par:</label>
                    <select id="filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        <option>Tout</option>
                        <!-- Ajouter d'autres options si nécessaire -->
                    </select>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">Vue d'ensemble des cours</h2>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-blue-500">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Libellé</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Module</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nombre d'heures</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Semestre</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="programmation-web.png" alt="Programmation Web" class="h-10 w-10 rounded-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="#" class="text-blue-500">Programmation Web</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Algèbre
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            60 heures
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Semestre 1
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img src="statistiques.png" alt="Statistiques" class="h-10 w-10 rounded-full">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="#" class="text-blue-500">Statistiques</a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Algèbre
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            45 heures
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            Semestre 1
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 flex justify-center">
                <nav aria-label="Pagination">
                    <ul class="inline-flex items-center -space-x-px">
                        <li>
                            <a href="#" class="px-3 py-1 ml-0 leading-tight text-white bg-blue-500 border border-gray-300 hover:bg-blue-600">1</a>
                        </li>
                        <li>
                            <a href="#" class="px-3 py-1 leading-tight text-blue-500 bg-white border border-gray-300 hover:bg-gray-200">2</a>
                        </li>
                        <li>
                            <a href="#" class="px-3 py-1 leading-tight text-blue-500 bg-white border border-gray-300 hover:bg-gray-200">3</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>
</body>
</html>
