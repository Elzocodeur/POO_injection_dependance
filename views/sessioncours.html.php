<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessions de cours</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .fc-event.terminé {
            background-color: #4CAF50;
        }

        .fc-event.non-effectué {
            background-color: #FFC107;
        }

        .fc-event.annulé {
            background-color: #F44336;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-sm p-4">
        <div class="container mx-auto flex items-center justify-between">
            <div class="text-xl font-bold">LOGO</div>
            <nav class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900">Accueil</a>
                <a href="#" class="text-gray-600 hover:text-gray-900">Sessions</a>
                <a href="/cours/filter" class="text-gray-600 hover:text-gray-900">Mes cours</a>
                <a href="/logout" class="text-gray-600 hover:text-gray-900">Logout</a>
            </nav>
        </div>
    </header>
    <div class="container mx-auto p-8">
        <h1 class="text-3xl font-bold mb-8">Sessions</h1>
        <div class="mb-4">
            <form method="GET" action="" class="inline-block">
                <select name="filter" onchange="this.form.submit()" class="p-2 border rounded">
                    <option value="all">Tous</option>
                    <option value="non effectué">Non effectué</option>
                    <option value="terminé">Terminé</option>
                    <option value="annulé">Annulé</option>
                </select>
            </form>
        </div>
        <div id="calendar"></div>
    </div>
    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                eventClick: function(calEvent, jsEvent, view) {
                    if (calEvent.className.includes('non-effectué')) {
                        Swal.fire({
                            title: 'Demande d\'annulation',
                            input: 'textarea',
                            inputLabel: 'Raison de la demande',
                            inputPlaceholder: 'Entrez la raison de votre demande d\'annulation...',
                            showCancelButton: true,
                            confirmButtonText: 'Envoyer la demande',
                            cancelButtonText: 'Annuler',
                            showLoaderOnConfirm: true,
                            eventClick: function(calEvent, jsEvent, view) {
                                if (calEvent.className.includes('non-effectué')) {
                                    $('#sessionId').val(calEvent.id);
                                    $('#annulationForm').show();
                                } else {
                                    alert('Vous ne pouvez faire une demande d\'annulation que pour les sessions non effectuées.');
                                }
                            },

                            allowOutsideClick: () => !Swal.isLoading()
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: 'Succès!',
                                    text: 'Votre demande d\'annulation a été envoyée avec succès.',
                                    icon: 'success'
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Action non autorisée',
                            text: 'Vous ne pouvez faire une demande d\'annulation que pour les sessions non effectuées.',
                            icon: 'warning'
                        });
                    }
                },
                events: [
                    <?php foreach ($sessions as $session) : ?> {
                            id: <?= $session->getId() ?>,
                            title: '<?= htmlspecialchars($session->getCoursLibelle()) ?>',
                            start: '<?= $session->getDate() ?>T<?= $session->getHeureDebut() ?>',
                            end: '<?= $session->getDate() ?>T<?= $session->getHeureFin() ?>',
                            className: '<?= str_replace(' ', '-', $session->getStatut()) ?>'
                        },
                    <?php endforeach; ?>
                ]
            });
        });
    </script>
</body>

</html>