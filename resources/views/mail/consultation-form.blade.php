<x-mail::message>
# FREE CONSULTATION FORM

<br>

<table>
    <tr>
        <td><strong>Subject</strong></td>
        <td>:</td>
        <td>{{ $consultation->subject }}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>:</td>
        <td>{{ $consultation->name }}</td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>:</td>
        <td>{{ $consultation->email }}</td>
    </tr>
    <tr>
        <td><strong>Nomor Whatsapp / HP</strong></td>
        <td>:</td>
        <td>{{ $consultation->phone }}</td>
    </tr>
    <tr>
        <td><strong>Area</strong></td>
        <td>:</td>
        <td>{{ $consultation->area }}</td>
    </tr>
    <tr>
        <td><strong>Consultation Detail</strong></td>
        <td>:</td>
        <td>{{ $consultation->message }}</td>
    </tr>
</table>

<br>
<br>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
