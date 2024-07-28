<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Absences</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
        <header class="bg-white shadow-sm p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-xl font-bold">LOGO</div>
            <nav class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Accueil</a>
                <a href="/absence" class="text-gray-600 hover:text-gray-900">Absence</a>
                
                <a href="/sessions/filter" class="text-gray-600 hover:text-gray-900">Sessions</a>
                <a href="/cours/filter" class="text-gray-600 hover:text-gray-900">Mes cours</a>
                <a href="/logout" class="text-gray-600 hover:text-gray-900">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </nav>
        </div>
    </header>

    <!-- Content -->
    <div class="max-w-6xl mx-auto mt-8">
        <div class="text-center text-2xl font-semibold mb-4">Vue d'ensemble des absences</div>
        <table class="min-w-full bg-white rounded-lg shadow-md">
            <thead>
                <tr class="bg-blue-500 text-white text-left">
                    <th class="py-2 px-4">Classe</th>
                    <th class="py-2 px-4">Module</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Heure début</th>
                    <th class="py-2 px-4">Heure fin</th>
                    <th class="py-2 px-4">Statut</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence): ?>
                    <tr>
                        <td class="border-t px-4 py-2"><?= htmlspecialchars($absence['classe_filiere'] . ' ' . $absence['classe_niveau']) ?></td>
                        <td class="border-t px-4 py-2"><?= htmlspecialchars($absence['module_libelle']) ?></td>
                        <td class="border-t px-4 py-2"><?= htmlspecialchars($absence['date']) ?></td>
                        <td class="border-t px-4 py-2"><?= htmlspecialchars($absence['heure_debut']) ?></td>
                        <td class="border-t px-4 py-2"><?= htmlspecialchars($absence['heure_fin']) ?></td>
                        <td class="border-t px-4 py-2"><?= $absence['etat'] === 'justifier' ? '<span class="text-green-500">Justifié</span>' : '<span class="text-red-500">Non justifié</span>' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>