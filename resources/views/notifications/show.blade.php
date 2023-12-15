<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Simple Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="m-4">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Schedule At</th>
                    <th>Frequency</th>
                    <th>Timezone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($notifications as $key => $notification)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $notification->user->getName() }}</td>
                        <td>{{ $notification->getScheduledAt() }}</td>
                        <td>{{ $notification->getFrequency() }}</td>
                        <td>{{ $notification->user->getTimezone() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
