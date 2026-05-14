<h1>Realtime Chat</h1>

@foreach($messages as $msg)
    <p>{{ $msg->message }}</p>
@endforeach

<form method="POST" action="/chat/send">
    @csrf

    <select name="receiver_id">
        @foreach($users as $user)
            <option value="{{ $user->id }}">
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <input type="text" name="message" placeholder="Ketik pesan...">
    
    <button type="submit">
        Kirim
    </button>
</form>