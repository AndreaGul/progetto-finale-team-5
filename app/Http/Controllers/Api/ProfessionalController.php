<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Professional;
use App\Models\Specialization;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index($param)
    {
        if(!empty($param)){
            // validazione
            $values = explode(',', $param);
            $ids = [];
            $specializations = Specialization::pluck('id')->toArray();
            foreach($values as $value){
                if(in_array($value, $specializations))$ids[] = $value;
            }

            if(count($ids) > 0){
                // se ci sono id validi | mostra solo l'ultima sponsorizzazione e solo se la data di fine è maggiore
                $current_time = now();// data e ora
                $professionals = Professional::whereHas('specializations', function ($query) use ($ids){
                    $query->whereIn('id', $ids);
                })->with(['specializations','sponsorizations' => function ($query) use($current_time){
                    $query->withPivot('professional_id', 'sponsorization_id', 'date_end_sponsorization')->where('date_end_sponsorization', '>', $current_time)->orderBy('date_end_sponsorization', 'desc')->limit(1);
                }])->paginate(10);
                return response()->json([
                    'status' => 'success',
                    'data' => $professionals
                ]);
            }else{
                // se gli di non sono validi
                return response()->json([
                    'status' => 'error',
                    'data' => 'invalid ids'
                ]);
            }
        }
    }
}
