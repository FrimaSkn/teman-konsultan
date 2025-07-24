<x-mail::message>
# ENQUIRY

<table>
    <tr>
        <td><strong>Subject</strong></td>
        <td>:</td>
        <td>{{ $contact->subject }}</td>
    </tr>
    <tr>
        <td><strong>Name</strong></td>
        <td>:</td>
        <td>{{ $contact->name }}</td>
    </tr>
    <tr>
        <td><strong>Email</strong></td>
        <td>:</td>
        <td>{{ $contact->email }}</td>
    </tr>
    <tr>
        <td><strong>Nomor Whatsapp / HP</strong></td>
        <td>:</td>
        <td>{{ $contact->phone }}</td>
    </tr>
    <tr>
        <td><strong>Message</strong></td>
        <td>:</td>
        <td>{{ $contact->message }}</td>
    </tr>
</table>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
