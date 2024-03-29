<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Professional;
use App\Models\Review;
use App\Models\Specialization;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProfessionalController extends Controller
{
    public function index()
    {
        if (is_numeric(request()->specialization_id)) {
            //specialization_id è l'id riferito alla specializzazione
            try {
                request()->validate([
                    'specialization_id' => ['exists:specializations,id'],
                    'vote' => ['nullable', 'numeric'],
                    'review' => ['nullable', 'numeric'],
                ]);
            } catch (ValidationException $e) {
                return response()->json(
                    [
                        'status' => 'failed',
                        'error' => $e->errors()
                    ],
                    422
                );
            }

            $specializations = Specialization::pluck('id')->toArray();
            $specialization_id = request()->specialization_id;
            $review = request()->review;
            $vote = request()->vote;
            if (in_array($specialization_id, $specializations)) {
                // se ci sono id validi | mostra solo l'ultima sponsorizzazione e solo se la data di fine è maggiore
                $current_time = now(); // data e ora
                $professionals = Professional::whereHas('specializations', function ($query) use ($specialization_id) {
                    $query->where('id', $specialization_id);
                })->with(['user', 'votes', 'reviews', 'specializations', 'sponsorizations' => function ($query) use ($current_time) {
                    $query->withPivot('professional_id', 'sponsorization_id', 'date_end_sponsorization')->where('date_end_sponsorization', '>', $current_time)->orderBy('date_end_sponsorization', 'desc');
                }])->withCount('reviews')->withCount(['votes as average_rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(lookup_id), 0)'));
                }])->get();

                // mostra prima chi è sponsorizzato
                $professionalsSponsored = $professionals->filter(function ($professional) {
                    // sponsorizzati
                    return $professional->sponsorizations->isNotEmpty();
                });
                $professionalsNotSponsored = $professionals->filter(function ($professional) {
                    // non sponsorizzati
                    return $professional->sponsorizations->isEmpty();
                });
                // unisce gli oggetti
                $professionals = $professionalsSponsored->merge($professionalsNotSponsored);


                if ($review && $vote) {
                    // tutto
                    $professionals = $professionals->filter(function ($professional) use ($review) {
                        return $professional->reviews_count >= $review;
                    });
                    $professionals = $professionals->filter(function ($professional) use ($vote) {
                        return $professional->average_rating >= $vote;
                    });
                } elseif ($review) {
                    // solo in base alle recensioni
                    $professionals = $professionals->filter(function ($professional) use ($review) {
                        return $professional->reviews_count >= $review;
                    });
                } elseif ($vote) {
                    // solo in base alla media dei voti
                    $professionals = $professionals->filter(function ($professional) use ($vote) {
                        return $professional->average_rating >= $vote;
                    });
                }

                return response()->json([
                    'status' => 'successo',
                    'data' => $professionals
                ]);
            } else {
                return response()->json([
                    'status' => 'errore',
                    'data' => 'id non valido'
                ]);
            }
        } else {
            //specialization_id è il nome della specializzazione
            try {
                request()->validate([
                    'specialization_id' => ['exists:specializations,name'],
                    'vote' => ['nullable', 'numeric'],
                    'review' => ['nullable', 'numeric'],
                ]);
            } catch (ValidationException $e) {
                return response()->json(
                    [
                        'status' => 'failed',
                        'error' => $e->errors()
                    ],
                    422
                );
            }

            $specializations = Specialization::pluck('name')->toArray();
            $specialization_name = request()->specialization_id;
            $review = request()->review;
            $vote = request()->vote;
            if (in_array($specialization_name, $specializations)) {
                // se ci sono id validi | mostra solo l'ultima sponsorizzazione e solo se la data di fine è maggiore
                $current_time = now(); // data e ora
                $professionals = Professional::whereHas('specializations', function ($query) use ($specialization_name) {
                    $query->where('name', $specialization_name);
                })->with(['user', 'votes', 'reviews', 'specializations', 'sponsorizations' => function ($query) use ($current_time) {
                    $query->withPivot('professional_id', 'sponsorization_id', 'date_end_sponsorization')->where('date_end_sponsorization', '>', $current_time)->orderBy('date_end_sponsorization', 'desc');
                }])->withCount('reviews')->withCount(['votes as average_rating' => function ($query) {
                    $query->select(DB::raw('coalesce(avg(lookup_id), 0)'));
                }])->get();

                // mostra prima chi è sponsorizzato
                $professionalsSponsored = $professionals->filter(function ($professional) {
                    // sponsorizzati
                    return $professional->sponsorizations->isNotEmpty();
                });
                $professionalsNotSponsored = $professionals->filter(function ($professional) {
                    // non sponsorizzati
                    return $professional->sponsorizations->isEmpty();
                });
                // unisce gli oggetti
                $professionals = $professionalsSponsored->merge($professionalsNotSponsored);

                if ($review && $vote) {
                    // tutto
                    $professionals = $professionals->filter(function ($professional) use ($review) {
                        return $professional->reviews_count >= $review;
                    });
                    $professionals = $professionals->filter(function ($professional) use ($vote) {
                        return $professional->average_rating >= $vote;
                    });
                } elseif ($review) {
                    // solo in base alle recensioni
                    $professionals = $professionals->filter(function ($professional) use ($review) {
                        return $professional->reviews_count >= $review;
                    });
                } elseif ($vote) {
                    // solo in base alla media dei voti
                    $professionals = $professionals->filter(function ($professional) use ($vote) {
                        return $professional->average_rating >= $vote;
                    });
                }

                return response()->json([
                    'status' => 'successo',
                    'data' => $professionals
                ]);
            } else {
                return response()->json([
                    'status' => 'errore',
                    'data' => 'id non valido'
                ]);
            }
        }
    }


    public function show($id)
    {
        if (is_numeric($id)) {
            $param = 'id';
        } else {
            $param = 'slug';
        }
        $professional = Professional::where($param, $id)->with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }])->with('messages', 'votes', 'user', 'specializations')->withCount(['votes as average_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(lookup_id), 0)'));
        }])->withCount('votes')->first();
        if ($professional) {
            return response()->json([
                'status' => 'success',
                'data' => $professional
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'invalid id'
            ]);
        }
    }

    public function addMessage()
    {
        try {
            request()->validate([
                'id' => ['exists:professionals,id'],
                'email' => ['string', 'max:50'],
                'message' => ['string'],
                'name' => ['string', 'max:30'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'status' => 'failed',
                    'error' => $e->errors()
                ],
                422
            );
        }


        $new_message = new Message();
        $new_message->professional_id = request()->id;
        $new_message->message = request()->message;
        $new_message->sender_email = request()->email;
        $new_message->name = request()->name;
        $new_message->save();

        return response()->json([
            'status' => 'success',
            'data' => ''
        ]);
    }

    public function addReview()
    {
        try {
            request()->validate([
                'id' => ['exists:professionals,id'],
                'email' => ['string', 'max:50'],
                'review' => ['string'],
                'name' => ['string', 'max:30'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'status' => 'failed',
                    'error' => $e->errors()
                ],
                422
            );
        }


        $new_review = new Review();
        $new_review->professional_id = request()->id;
        $new_review->review = request()->review;
        $new_review->email_reviewer = request()->email;
        $new_review->name_reviewer = request()->name;
        $new_review->save();

        return response()->json([
            'status' => 'success',
            'data' => ''
        ]);
    }

    public function addVote()
    {
        try {
            request()->validate([
                'professional_id' => ['exists:professionals,id'],
                'lookup_id' => ['exists:lookup_votes,id'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(
                [
                    'status' => 'failed',
                    'error' => $e->errors()
                ],
                422
            );
        }


        $new_vote = new Vote();
        $new_vote->professional_id = request()->professional_id;
        $new_vote->lookup_id = request()->lookup_id;
        $new_vote->save();

        return response()->json([
            'status' => 'success',
            'data' => ''
        ]);
    }

    public function sponsored()
    {
        // mostra solo sponsorizzati
        $current_time = now(); // data e ora
        $professionals = Professional::with(['user', 'votes', 'reviews', 'specializations', 'sponsorizations' => function ($query) use ($current_time) {
            $query->withPivot('professional_id', 'sponsorization_id', 'date_end_sponsorization')->where('date_end_sponsorization', '>', $current_time)->orderBy('date_end_sponsorization', 'desc');
        }])->withCount('reviews')->withCount(['votes as average_rating' => function ($query) {
            $query->select(DB::raw('coalesce(avg(lookup_id), 0)'));
        }]);

        // Applica la logica di filtro
        $professionalsSponsored = $professionals->whereHas('sponsorizations', function ($query) {
            $query->where('date_end_sponsorization', '>', now()); // Filtra solo i professionisti sponsorizzati
        });

        // Ora puoi paginare i risultati
        $professionalsPaginated = $professionalsSponsored->paginate(3);
        if ($professionals) {
            return response()->json([
                'status' => 'success',
                'data' => $professionalsPaginated
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'invalid id'
            ]);
        }
    }
}
