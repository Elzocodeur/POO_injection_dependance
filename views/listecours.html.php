<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des cours</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200 min-h-screen">
    <!-- Header Section -->
    <header class="bg-white shadow-sm p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-xl font-bold">LOGO</div>
            <nav class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Accueil</a>
                <a href="/absence" class="text-gray-600 hover:text-gray-900">Absence</a>
                
                <a href="/sessions/filter" class="text-gray-600 hover:text-gray-900">Sessions</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Mes cours</a>
                <a href="/logout" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Section -->
    <main class="container mx-auto mt-8">
        <section class="mb-8 flex space-x-4">
            <form method="GET" action="" class="relative inline-block mt-4">
                <select name="filter" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100">
                    <option value="all" <?= $currentFilter === 'all' ? 'selected' : '' ?>>Tout</option>
                    <option value="today" <?= $currentFilter === 'today' ? 'selected' : '' ?>>Aujourd'hui</option>
                    <option value="week" <?= $currentFilter === 'week' ? 'selected' : '' ?>>Cette semaine</option>
                </select>
            </form>

            <form method="GET" action="" class="relative inline-block mt-4">
                <select name="semestre" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100">
                    <option value="">Tous les semestres</option>
                    <?php foreach ($semestres as $semestre) : ?>
                        <option value="<?= $semestre['id'] ?>" <?= $currentSemestre == $semestre['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($semestre['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
            <form method="GET" action="" class="relative inline-block mt-4">
                <select name="module" onchange="this.form.submit()" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg shadow-sm hover:bg-gray-100">
                    <option value="">Tous les modules</option>
                    <?php foreach ($modules as $module) : ?>
                        <option value="<?= $module['id'] ?>" <?= $currentModule == $module['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($module['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </section>
        <section class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-2xl font-bold mb-4">Vue d'ensemble des cours</h1>
            <?php if (empty($cours)) : ?>
                <p>Aucun cours n'a été trouvé.</p>
            <?php else : ?>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-blue-500 text-white">
                        <tr>
                            <th class="py-2 px-4 border-b text-center">Photo</th>
                            <th class="py-2 px-4 border-b text-center">Libellé</th>
                            <th class="py-2 px-4 border-b text-center">Module</th>
                            <th class="py-2 px-4 border-b text-center">Nombre d'heures</th>
                            <th class="py-2 px-4 border-b text-center">Semestre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cours as $course) : ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center">
                                    <img src="<?= htmlspecialchars($course->getPhoto()) ?>" alt="<?= htmlspecialchars($course->getLibelle()) ?>" class="w-20 h-20 object-cover rounded mx-auto">
                                </td>
                                <td class="py-2 px-4 border-b font-bold text-blue-500 text-center"><?= htmlspecialchars($course->getLibelle()) ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($course->getModuleLibelle()) ?? '' ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= htmlspecialchars($course->getNombreHeures()) ?> heures</td>
                                <td class="py-2 px-4 border-b text-center">Semestre <?= htmlspecialchars($course->getSemestre()) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-4 flex justify-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <a href="?filter=<?= $currentFilter ?>&page=<?= $i ?>" class="mx-1 px-3 py-2 bg-blue-500 text-white rounded <?= $i === $currentPage ? 'font-bold' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        </section>
    </main>
</body>

</html>