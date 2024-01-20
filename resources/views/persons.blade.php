<!-- resources/views/persons.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persons</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <span class="font-weight-bold">Execution time:</span> {{ $executionTime }} seconds

    <form class="form-inline mt-3">
        <label class="mr-2" for="birth_year">Birth Year:</label>
        <input type="text" class="form-control mr-2" name="birth_year" id="birth_year" value="{{ request('birth_year') }}" />

        <label class="mr-2" for="birth_month">Birth Month:</label>
        <input type="text" class="form-control mr-2" name="birth_month" id="birth_month" value="{{ request('birth_month') }}" />

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <table class="table table-bordered mt-3">
        <!-- Table header -->
        <thead class="thead-dark">
        <tr>
            <th>Name</th>
            <th>Birth Year</th>
            <th>Birth Month</th>
        </tr>
        </thead>
        <!-- Table body -->
        <tbody>
        @foreach ($people as $person)
            <tr>
                <td>{{ $person->name }}</td>
                <td>{{ $person->birth_year }}</td>
                <td>{{ $person->birth_month }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="mt-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                {{-- Previous Page Link --}}
                @if ($people->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo; Previous</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $people->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @php
                    $startPage = max(1, $people->currentPage() - 2);
                    $endPage = min($people->lastPage(), $people->currentPage() + 2);
                @endphp

                @for ($i = $startPage; $i <= $endPage; $i++)
                    <li class="page-item {{ ($i == $people->currentPage()) ? 'active' : '' }}">
                        <a class="page-link" href="{{ $people->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page Link --}}
                @if ($people->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $people->nextPageUrl() }}" rel="next">Next &raquo;</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link">Next &raquo;</span>
                    </li>
                @endif
            </ul>
        </nav>

        <div class="text-center">
            <p class="mb-0">Page {{ $people->currentPage() }} of {{ $people->lastPage() }}, showing {{ $people->firstItem() }}-{{ $people->lastItem() }} of {{ $people->total() }} results.</p>
        </div>
    </div>


</div>

<!-- Include Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
