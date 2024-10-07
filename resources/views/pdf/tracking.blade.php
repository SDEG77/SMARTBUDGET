@php
    use Carbon\Carbon;
    Carbon::setLocale('en'); 
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

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
  <h1>Tracker Data (ALL)</h1>
  <table border="2">
      <thead>
          <tr>
              <th>Mode</th>
              <th>Category</th>
              <th>Description</th>
              <th>
                Amount  
                <span style="display: block ;font-size: 13px; color: rgba(39, 39, 39, 0.816)">
                    (Philippine Peso)
                </span>
              </th>
              <th>Date</th>
          </tr>
      </thead>
      <tbody>
          @foreach ($datas as $dundun)
              @php
                $date = Carbon::createFromFormat('Y-m-d', $dundun->date);
              @endphp
  
              <tr>
                  <td>{{ $dundun->mode }}</td>
                  <td>{{ $dundun->category }}</td>
                  <td>{{ $dundun->description }}</td>
                  <td>{{ number_format($dundun->amount) }}</td>
                  <td>{{ $date->translatedFormat('F j, Y') }}</td>
              </tr>
          @endforeach
      </tbody>
  </table>
</body>
</html>