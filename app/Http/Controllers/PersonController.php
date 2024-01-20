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

        $page = $request->input('page', 1);

        $cacheKey = 'filtered_people:' . serialize($request->only(['birth_year', 'birth_month'])) . ':page_' . $page;

        $people = Cache::remember($cacheKey, 60, function () use ($request) {
            return Person::when($request->filled('birth_year'), function ($query) use ($request) {
                $query->whereYear('birthday', $request->input('birth_year'));
            })
            ->when($request->filled('birth_month'), function ($query) use ($request) {
                $query->whereMonth('birthday', $request->input('birth_month'));
            })
            ->when($request->filled('birth_year') && $request->filled('birth_month'), function ($query) use ($request) {
                $query->whereRaw("DATE_FORMAT(birthday, '%Y') = ?", [$request->input('birth_year')])
                    ->whereRaw("DATE_FORMAT(birthday, '%m') = ?", [$request->input('birth_month')]);
            })
            ->paginate(20);
        });

        if (!Cache::has($cacheKey)) {
            $people = Person::when($request->filled('birth_year'), function ($query) use ($request) {
                $query->whereYear('birthday', $request->input('birth_year'));
            })
            ->when($request->filled('birth_month'), function ($query) use ($request) {
                $query->whereMonth('birthday', $request->input('birth_month'));
            })
            ->when($request->filled('birth_year') && $request->filled('birth_month'), function ($query) use ($request) {
                $query->whereRaw("DATE_FORMAT(birthday, '%Y') = ?", [$request->input('birth_year')])
                    ->whereRaw("DATE_FORMAT(birthday, '%m') = ?", [$request->input('birth_month')]);
            })
            ->paginate(20);

            Cache::put($cacheKey, $people, 60);
        }

        $endTime = microtime(true);
        $executionTime = $endTime - $startTime;


        return view('persons', [
            'people' => $people,
            'executionTime' => $executionTime,
            'cacheKey' => $cacheKey,
        ]);
    }
}
