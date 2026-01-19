<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f3f4f6;
        }

        h2 {
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <h2>Piggery System Report</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Weight (kg)</th>
                <th>Status</th>
                <th>Type</th>
                <th>Purpose</th>
                <th>Price</th>
                <th>Date Added</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pigs as $index => $pig)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pig->weight }}</td>
                    <td>{{ $pig->status }}</td>
                    <td>{{ $pig->type }}</td>
                    <td>{{ $pig->purpose }}</td>
                    <td>{{ number_format($pig->price, 2) }}</td>
                    <td>{{ $pig->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
