<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PersonController extends Controller
{
    public function filter(Request $request)
    {
        $startTime = microtime(true);
        $cacheKey = 'persons:' . md5(serialize($request->all()));
        
        $perPage = 20;
        $result = Cache::get($cacheKey);

        if (!$result) {
            info('nocache');
            $query = Person::query();
            
            if ($request->has('birth_year')) {
                $query->where('birth_year', $request->input('birth_year'));
            }

            if ($request->has('birth_month')) {
                $query->where('birth_month', $request->input('birth_month'));
            }

            $result = $query->paginate($perPage);
            Cache::put($cacheKey, $result, 60);
        }else{
            info('cache');
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;
        return response()->json(['cache-key' => $cacheKey,'execution_time' => $executionTime]);
    }
}