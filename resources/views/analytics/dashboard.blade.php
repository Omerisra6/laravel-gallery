@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Analytics Dashboard</h1>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <form action="{{ route('analytics.dashboard') }}" method="GET" class="form-inline">
                    <div class="form-group mr-2">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control ml-2" value="{{ $startDate }}">
                    </div>
                    <div class="form-group mr-2">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control ml-2" value="{{ $endDate }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Video Views Over Time</div>
                    <div class="card-body">
                        {{-- Chart component for view counts over time --}}
                        <x-charts.line-chart :data="$viewCounts" x-key="date" y-key="count"></x-charts.line-chart>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Engagement Over Time</div>
                    <div class="card-body">
                        {{-- Chart component for engagement counts over time --}}
                        <x-charts.line-chart :data="$engagementCounts" x-key="date" y-key="count"></x-charts.line-chart>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Top Videos by Views</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Video Title</th>
                                    <th>View Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topVideosByViews as $video)
                                    <tr>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->view_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Top Videos by Engagement</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Video Title</th>
                                    <th>Engagement Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($topVideosByEngagement as $video)
                                    <tr>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->engagement_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection