<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PersonController extends Controller
{
    public function filter(Request $request)
    {
        $cacheKey = 'persons:' . md5(serialize($request->all()));
        $perPage = 20;

        $result = Cache::remember($cacheKey, 60, function () use ($request, $perPage) {
            $query = Person::query();

            // Apply filters
            if ($request->has('birth_year')) {
                $query->where('birth_year', $request->input('birth_year'));
            }

            if ($request->has('birth_month')) {
                $query->where('birth_month', $request->input('birth_month'));
            }

            return $query->paginate($perPage);
        });

        dd($result);

        return view('persons.index', compact('result'));
    }
}
