@props(['order', 'count'])
<tr class="table_row" id="{{ $order->id }}">
    <td>{{ $count }}</td>
        <td class="column-1">
            {{ $order->total_price }}
        </td>
        <td class="column-2">{{ $order->address }}</td>
        <td class="column-3">{{ $order->payment_method }}</td>
        <td class="column-4">{{ $order->total_quantity }}</td>
        <td class="column-5">{{ $order->created_at->format('Y-m-d') }}</td>
        <td class="column-5">{{ $order->money_received }}</td>
        <td> <a href="{{ route('confirm_order', ['id' => $order->id]) }}">
                <button
                    style="background-color: blue; color: white; border: none; padding: 10px 20px; font-size: 12px; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease;">See
                    Details</button>

            </a>
        </td>
</tr>
