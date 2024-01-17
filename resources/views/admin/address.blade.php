@if (@isset($address) and !@empty($address))
    <style>
        table {
            width: 100%;
        }

        td,
        th {
            text-align: right;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dee2e6;
        }
    </style>
    <table>
        <tr>
            <th>{{ __('key') }}</th>
            <th>{{ __('value') }}</th>
        </tr>
        <tr>
            <td>{{ __('id') }}</td>
            <td>{{ $address->id }}</td>
        </tr>
        <tr>
            <td>{{ __('title') }}</td>
            <td>{{ $address->title }}</td>
        </tr>
        <tr>
            <td>{{ __('recipient_name') }}</td>
            <td>{{ $address->recipient_name }}</td>
        </tr>
        <tr>
            <td>{{ __('country') }}</td>
            <td>{{ $address->country }}</td>
        </tr>
        <tr>
            <td>{{ __('State') }}</td>
            <td>{{ $address->state }}</td>
        </tr>
        <tr>
            <td>{{ __('address_line_1') }}</td>
            <td>{{ $address->address_line_1 }}</td>
        </tr>
        <tr>
            <td>{{ __('address_line_2') }}</td>
            <td>{{ $address->address_line_2 }}</td>
        </tr>
        <tr>
            <td>{{ __('phone_number') }}</td>
            <td>{{ $address->phone_number }}</td>
        </tr>
        <tr>
            <td>{{ __('created_at') }}</td>
            <td>{{ $address->created_at }}</td>
        </tr>
        <tr>
    </table>
@else
@endif
