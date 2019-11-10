@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    Fix the errors below and try again
                                    <br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="autolink">{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <form action="{{ route('schedule.update') }}" method="post">
                            @csrf
                            <table class="table table-hover">
                                <tr>
                                    <th>#</th>
                                    <th>Day</th>
                                    <th>Start</th>
                                    <th>End</th>
                                </tr>
                                @foreach(\App\Schedule::query()->orderBy('day_int', 'ASC')->get() as $schedule)
                                    <tr>
                                        <td>{{ $schedule->day_int }}</td>
                                        <td>{{ $schedule->day_string }}</td>
                                        <td>
                                            <input
                                                type="number"
                                                class="form-control {{ $errors->has("start.{$schedule->day_int}") ? "is-invalid" : "is-valid" }}"
                                                name="start[{{ $schedule->day_int }}]"
                                                value="{{ $schedule->start }}"
                                                required
                                                min="0"
                                                max="23">
                                            @if ($errors->has("start.{$schedule->day_int}"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("start.{$schedule->day_int}") }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <input
                                                type="number"
                                                class="form-control {{ $errors->has("end.{$schedule->day_int}") ? "is-invalid" : "is-valid" }}"
                                                name="end[{{ $schedule->day_int }}]"
                                                value="{{ $schedule->end }}"
                                                required
                                                min="0"
                                                max="23">
                                            @if ($errors->has("end.{$schedule->day_int}"))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first("end.{$schedule->day_int}") }}
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>

                            <button type="submit" class="btn btn-success w-100">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
