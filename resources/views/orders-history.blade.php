<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order History</title>
    <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
            margin-top: 60px;
            margin-bottom: 50%
        }



        .order-table th,
        .order-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* .order-table th {
            background-color: #f2f2f2;
        } */
    </style>
</head>

<body>
    <x-layout>
        <table class="order-table">
            <tr style="dis">
                <th>Toatal Price</th>
                <th>Address</th>
                <th>Payment method</th>
                <th>Total Items</th>
                <th>Date</th>
                <th>Money received</th>
            </tr>
            @foreach ($orders as $order)
                <x-order-history-row :order="$order">

                </x-order-history-row>
            @endforeach
        </table>

    </x-layout>
</body>

</html>
