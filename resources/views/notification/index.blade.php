@extends('layouts.app') @section('content')
<div class="card">
    <div class="card-header">Notifications</div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Subject</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifications as $notification)
                <tr>
                    <th>
                        {{ $loop->iteration + $notifications->firstItem() - 1 }}
                    </th>
                    <td><a href="{{ $notification->data['url'] ?? '#' }}">{{ $notification->data['message'] ?? null }}</a></td>
                    <td>{{ $notification->created_at->format('d/m/Y g:i A') }}</td>
                </tr>
                @empty
                <tr>
                  <td colspan="3">No new notification</td>
              </tr>
                @endforelse
            </tbody>
        </table>

        {{ $notifications->links() }}
    </div>
</div>
@endsection
