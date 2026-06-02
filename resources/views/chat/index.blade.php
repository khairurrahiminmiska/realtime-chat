<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime Chat</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:0;
            background:#f5f5f5;
        }

        .header{
            background:#2563eb;
            color:white;
            padding:15px;
        }

        .container{
            display:flex;
            height:90vh;
        }

        .sidebar{
            width:250px;
            background:white;
            padding:15px;
            border-right:1px solid #ddd;
            overflow-y:auto;
        }

        .chat-area{
            flex:1;
            padding:20px;
        }

        .user-item,
        .group-item{
            display:block;
            padding:10px;
            margin-bottom:8px;
            background:#f1f5f9;
            border-radius:8px;
            text-decoration:none;
            color:black;
        }

        .chat-box{
            background:white;
            height:70vh;
            overflow-y:auto;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
        }

        .message{
            padding:10px;
            margin-bottom:10px;
            background:#e5e7eb;
            border-radius:8px;
        }

        .sender{
            font-weight:bold;
            color:#2563eb;
        }

        .send-form{
            display:flex;
            gap:10px;
        }

        .send-form input{
            flex:1;
            padding:10px;
        }

        .send-form button{
            padding:10px 20px;
        }
    </style>
</head>
<body>

<div class="header">

    <h2>Realtime Chat</h2>

    Login sebagai:
    <b>{{ auth()->user()->name }}</b>

</div>

<div class="container">

    <div class="sidebar">

        <h3>Kontak</h3>

        @foreach($users as $user)

            <a
                class="user-item"
                href="/chat?user_id={{ $user->id }}"
            >
                👤 {{ $user->name }}
            </a>

        @endforeach

        <hr>

        <h3>Group</h3>

        @foreach($groups as $group)

            <a
                class="group-item"
                href="/group/{{ $group->id }}"
            >
                👥 {{ $group->name }}
            </a>

        @endforeach

        <hr>

        <h3>Buat Group</h3>

        <form action="/group/create" method="POST">

            @csrf

            <input
                type="text"
                name="name"
                placeholder="Nama Group"
                required
            >

            <br><br>

            @foreach($users as $user)

                <label>

                    <input
                        type="checkbox"
                        name="users[]"
                        value="{{ $user->id }}"
                    >

                    {{ $user->name }}

                </label>

                <br>

            @endforeach

            <br>

            <button type="submit">
                Buat
            </button>

        </form>

    </div>

    <div class="chat-area">

        <h3>
            @if(request('user_id'))
                Chat Pribadi
            @else
                Pilih kontak untuk memulai chat
            @endif
        </h3>

        <div class="chat-box">

            @foreach($messages as $msg)

                <div class="message">

                    <div class="sender">
                        {{ $msg->sender->name ?? 'User' }}
                    </div>

                    <div>
                        {{ $msg->message }}
                    </div>

                </div>

            @endforeach

        </div>

        @if(request('user_id'))

        <form
            method="POST"
            action="/chat/send"
            class="send-form"
        >

            @csrf

            <input
                type="hidden"
                name="receiver_id"
                value="{{ request('user_id') }}"
            >

            <input
                type="text"
                name="message"
                placeholder="Ketik pesan..."
                required
            >

            <button type="submit">
                Kirim
            </button>

        </form>

        @endif

    </div>

</div>

</body>
</html>