@extends('layouts.admin')

@section('content')
    <div class="container d-flex align-items-start flex-wrap">
        <h1 class="title-color mt-3 col-12 title-bold">Informazioni personali</h1>
        {{-- <div class="left col-4">
            <ul class="list-unstyled">

                <li>
                    @if (isset($professional->photo) && Storage::exists($professional->photo))
                        <img src="{{ asset('storage/' . $professional->photo) }}" alt="foto profilo assente" class="user-img">
                    @elseif(isset($professional->photo))
                        <img src="{{ $professional->photo }}" alt="foto profilo assente" class="user-img">
                    @else
                        <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/26530210-moderno-persona-icona-utente-e-anonimo-icona-vettore-vettoriale.jpg"
                            alt="foto profilo assente" class="user-img">
                    @endif
                </li>
                <li><span class="title-secondary-color fw-bolder">Nome : </span>{{ $user->name }}</li>
                <li><span class="title-secondary-color fw-bolder">Cognome : </span> {{ $user->surname }}</li>
                <li><span class="title-secondary-color fw-bolder">Email : </span> {{ $user->email }}</li>
                <li>
                    @if (isset($professional->curriculum))
                        <a class="title-secondary-color fw-bolder" target="_blank"
                            href="{{ asset('storage/' . $professional->curriculum) }}">Curriculum vitae</a>
                    @else
                        <span class="title-secondary-color fw-bolder">Curriculum: </span>assente
                    @endif

                </li>

                <li><span class="title-secondary-color fw-bolder">Numero telefono: </span>
                    {{ $professional->phone ?: 'Nessun numero di telefono inserito' }}</li>
                <li><span class="title-secondary-color fw-bolder">Indirizzo : </span>
                    {{ $professional->address ?: 'Nessun indirizzio inserito' }}</li>
                <li><span class="title-secondary-color fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
                <li>
                    <span class="title-secondary-color fw-bolder">Specializzazioni : </span>
                    <ul>
                        @foreach ($professional->specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </li>
                <li><span class="title-secondary-color fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>

            </ul>

            <a class="btn btn-color text-light" href="{{ route('admin.info.edit', $user) }}">Modifica</a>
        </div> --}}
        <div class="card mb-4" style="width: 18rem;">
            @if (isset($professional->photo) && Storage::exists($professional->photo))
                <img src="{{ asset('storage/' . $professional->photo) }}" alt="foto profilo assente"
                    class="card-img-top user-img">
            @elseif(isset($professional->photo))
                <img src="{{ $professional->photo }}" alt="foto profilo assente" class="card-img-top user-img">
            @else
                <img src="https://static.vecteezy.com/ti/vettori-gratis/p3/26530210-moderno-persona-icona-utente-e-anonimo-icona-vettore-vettoriale.jpg"
                    alt="foto profilo assente" class="card-img-top user-img">
            @endif
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Nome : </span>{{ $user->name }}
                </li>
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Cognome : </span>
                    {{ $user->surname }}</li>
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Email : </span>
                    {{ $user->email }}</li>
                <li class="list-group-item">
                    @if (isset($professional->curriculum))
                        <a class="title-secondary-color fw-bolder" target="_blank"
                            href="{{ asset('storage/' . $professional->curriculum) }}">Curriculum vitae</a>
                    @else
                        <span class="title-secondary-color fw-bolder">Curriculum: </span>assente
                    @endif

                </li>

                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Numero telefono: </span>
                    {{ $professional->phone ?: 'Nessun numero di telefono inserito' }}</li>
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Indirizzo : </span>
                    {{ $professional->address ?: 'Nessun indirizzio inserito' }}</li>
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
                <li class="list-group-item">
                    <span class="title-secondary-color fw-bolder">Specializzazioni : </span>
                    <ul>
                        @foreach ($professional->specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </li>
                <li class="list-group-item"><span class="title-secondary-color fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
            </ul>
            <div class="card-body">
                <a class="btn btn-color text-light" href="{{ route('admin.info.edit', $user) }}">Modifica</a>
            </div>
        </div>
        <div class="right col-6 ps-5">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const months = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre',
            'Ottobre', 'Novembre', 'Dicembre'
        ];
        // ordina i mesi (ultimi 12)
        const currentMonth = new Date().getMonth();
        const thisYearMonths = [];
        const lastYearMonths = [];
        months.forEach((element, key) => {
            if (key <= currentMonth) {
                thisYearMonths.push(element);
            } else {
                lastYearMonths.push(element);
            }
        });
        const orderMonths = lastYearMonths.concat(thisYearMonths);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: orderMonths,
                datasets: [{
                        label: 'messaggi',
                        data: [
                            {{ $monthlyMessageCounts[1] }},
                            {{ $monthlyMessageCounts[2] }},
                            {{ $monthlyMessageCounts[3] }},
                            {{ $monthlyMessageCounts[4] }},
                            {{ $monthlyMessageCounts[5] }},
                            {{ $monthlyMessageCounts[6] }},
                            {{ $monthlyMessageCounts[7] }},
                            {{ $monthlyMessageCounts[8] }},
                            {{ $monthlyMessageCounts[9] }},
                            {{ $monthlyMessageCounts[10] }},
                            {{ $monthlyMessageCounts[11] }},
                            {{ $monthlyMessageCounts[12] }},
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'recensioni',
                        data: [
                            {{ $monthlyReviewCounts[1] }},
                            {{ $monthlyReviewCounts[2] }},
                            {{ $monthlyReviewCounts[3] }},
                            {{ $monthlyReviewCounts[4] }},
                            {{ $monthlyReviewCounts[5] }},
                            {{ $monthlyReviewCounts[6] }},
                            {{ $monthlyReviewCounts[7] }},
                            {{ $monthlyReviewCounts[8] }},
                            {{ $monthlyReviewCounts[9] }},
                            {{ $monthlyReviewCounts[10] }},
                            {{ $monthlyReviewCounts[11] }},
                            {{ $monthlyReviewCounts[12] }},
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'voti',
                        data: [
                            {{ $monthlyVoteCounts[1] }},
                            {{ $monthlyVoteCounts[2] }},
                            {{ $monthlyVoteCounts[3] }},
                            {{ $monthlyVoteCounts[4] }},
                            {{ $monthlyVoteCounts[5] }},
                            {{ $monthlyVoteCounts[6] }},
                            {{ $monthlyVoteCounts[7] }},
                            {{ $monthlyVoteCounts[8] }},
                            {{ $monthlyVoteCounts[9] }},
                            {{ $monthlyVoteCounts[10] }},
                            {{ $monthlyVoteCounts[11] }},
                            {{ $monthlyVoteCounts[12] }},
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        max: {{ $maxHeight + 1 }}
                    }
                }
            }
        });
    </script>
@endsection
