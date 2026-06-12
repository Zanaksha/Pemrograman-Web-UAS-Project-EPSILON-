@extends('layouts.mainlayout')

@section('content')



<script>

function sendMessage()
{
    let message =
        document.getElementById('message').value;

    fetch('/chatbot/send', {

        method: 'POST',

        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },

        body: JSON.stringify({
            message: message
        })

    })

    .then(response => response.json())

    .then(data => {

        document.getElementById('chat-box').innerHTML +=
        `
        <div><b>Anda:</b> ${message}</div>
        <div><b>Bot:</b> ${data.reply}</div>
        <hr>
        `;

        document.getElementById('message').value = '';

    });
}

</script>

@endsection