<!DOCTYPE html>
<html>
<head>
    <title>Table Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            font-size: 20px
        }
        td {
            font-size: 18px
        }
    </style>
</head>
<body>
    <h1>Ledger Data (ALL)</h1>
    <table border="2" >
        <thead>
            <tr>
                <th>Type</th>
                <th>What</th>
                <th>Where</th>
                <th>When</th>
                <th>
                    Amount  
                    <span style="display: block ;font-size: 13px; color: rgba(39, 39, 39, 0.816)">
                        (Philippine Peso)
                    </span>
                </th>
                <th>Checked</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $dundun)
                <tr>
                    <td>{{ $dundun->type }}</td>
                    <td>{{ $dundun->what }}</td>
                    <td>{{ $dundun->when }}</td>
                    <td>{{ $dundun->where }}</td>
                    <td>{{ $dundun->amount }}</td>
                    <td>{{ $dundun->checked === 0 ? 'Not Done' : 'Done'}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
