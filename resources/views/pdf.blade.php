<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>📊 Reporte de Ventas</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            background-color: #ffffff;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h2 {
            color: #4b0082;
            font-size: 30px;
            margin: 0;
        }

        .header p {
            font-size: 14px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            overflow: hidden;
        }

        thead tr {
            background: linear-gradient(to right, #6a11cb, #2575fc);
        }

        th, td {
            padding: 12px 15px;
            font-size: 13px;
        }

        th {
            color: #fff;
            text-align: left;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tbody tr:hover {
            background-color: #e0e7ff;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            color: #2e7d32;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 50px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <!-- Si tienes un logo, descomenta esta línea -->
        <!-- <img src="ruta/logo.png" class="logo" alt="Logo"> -->
        <h2>📊 Reporte de Ventas</h2>
        <p>Reporte detallado de las ventas registradas</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Cliente</th>
                <th>Total (Bs.)</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $venta->cliente_nombre }}</td>
                <td>{{ $venta->total }}</td>
                <td>{{ $venta->fecha_registro }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        💰 Suma total: {{ $total }} Bs.
    </div>

    <div class="footer">
        Sistema de Reportes - Estrellitas<br>
        Generado automáticamente el {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
