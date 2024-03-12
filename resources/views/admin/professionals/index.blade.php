@extends('layouts.admin')

@section('content')

    <div class="container d-flex align-items-end flex-wrap">
        <h1 class="text-primary mt-3 col-12">Info</h1>
        <div class="left col-4">
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
                <li><span class="text-primary-emphasis fw-bolder">Nome : </span>{{ $user->name }}</li>
                <li><span class="text-primary-emphasis fw-bolder">Cognome : </span> {{ $user->surname }}</li>
                <li><span class="text-primary-emphasis fw-bolder">Email : </span> {{ $user->email }}</li>
                <li>
                    @if (isset($professional->curriculum))
                        <a class="text-primary-emphasis fw-bolder" target="_blank"
                            href="{{ asset('storage/' . $professional->curriculum) }}">Curriculum vitae</a>
                    @else
                        <span class="text-primary-emphasis fw-bolder">Curriculum: </span>assente
                    @endif
    
                </li>
    
                <li><span class="text-primary-emphasis fw-bolder">Numero telefono: </span>
                    {{ $professional->phone ?: 'Nessun numero di telefono inserito' }}</li>
                <li><span class="text-primary-emphasis fw-bolder">Indirizzo : </span>
                    {{ $professional->address ?: 'Nessun indirizzio inserito' }}</li>
                <li><span class="text-primary-emphasis fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
                <li>
                    <span class="text-primary-emphasis fw-bolder">Specializzazioni : </span>
                    <ul>
                        @foreach ($professional->specializations as $specialization)
                            <li>{{ $specialization->name }}</li>
                        @endforeach
                    </ul>
                </li>
                <li><span class="text-primary-emphasis fw-bolder">Descrizione : </span>
                    {{ $professional->performance ?: 'Nessuna descrizione inserita' }}</li>
    
            </ul>
    
            <a class="btn btn-primary text-light" href="{{ route('admin.info.edit', $user) }}">Modifica</a>
        </div>
        <div class="right col-6">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>
      
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      
      <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
            datasets: [{
              label: 'messaggi',
              data: [
                '<?php echo $monthlyMessageCounts[1] ?>',
                '<?php echo $monthlyMessageCounts[2] ?>',
                '<?php echo $monthlyMessageCounts[3] ?>',
                '<?php echo $monthlyMessageCounts[4] ?>',
                '<?php echo $monthlyMessageCounts[5] ?>',
                '<?php echo $monthlyMessageCounts[6] ?>',
                '<?php echo $monthlyMessageCounts[7] ?>',
                '<?php echo $monthlyMessageCounts[8] ?>',
                '<?php echo $monthlyMessageCounts[9] ?>',
                '<?php echo $monthlyMessageCounts[10] ?>',
                '<?php echo $monthlyMessageCounts[11] ?>',
                '<?php echo $monthlyMessageCounts[12] ?>',
            ],
              borderWidth: 1
            },
            {
              label: 'recensioni',
              data: [
                '<?php echo $monthlyReviewCounts[1] ?>',
                '<?php echo $monthlyReviewCounts[2] ?>',
                '<?php echo $monthlyReviewCounts[3] ?>',
                '<?php echo $monthlyReviewCounts[4] ?>',
                '<?php echo $monthlyReviewCounts[5] ?>',
                '<?php echo $monthlyReviewCounts[6] ?>',
                '<?php echo $monthlyReviewCounts[7] ?>',
                '<?php echo $monthlyReviewCounts[8] ?>',
                '<?php echo $monthlyReviewCounts[9] ?>',
                '<?php echo $monthlyReviewCounts[10] ?>',
                '<?php echo $monthlyReviewCounts[11] ?>',
                '<?php echo $monthlyReviewCounts[12] ?>',
            ],
              borderWidth: 1
            },
            {
              label: 'voti',
              data: [
                '<?php echo $monthlyVoteCounts[1] ?>',
                '<?php echo $monthlyVoteCounts[2] ?>',
                '<?php echo $monthlyVoteCounts[3] ?>',
                '<?php echo $monthlyVoteCounts[4] ?>',
                '<?php echo $monthlyVoteCounts[5] ?>',
                '<?php echo $monthlyVoteCounts[6] ?>',
                '<?php echo $monthlyVoteCounts[7] ?>',
                '<?php echo $monthlyVoteCounts[8] ?>',
                '<?php echo $monthlyVoteCounts[9] ?>',
                '<?php echo $monthlyVoteCounts[10] ?>',
                '<?php echo $monthlyVoteCounts[11] ?>',
                '<?php echo $monthlyVoteCounts[12] ?>',
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
                }
              }
            }
          }
        });
      </script>
@endsection
