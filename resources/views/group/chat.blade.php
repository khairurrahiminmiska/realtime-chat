<!DOCTYPE html>
<html>
<head>
    <title>{{ $group->name }}</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            background:#f5f5f5;
            margin:0;
        }

        .header{
            background:#2563eb;
            color:white;
            padding:15px;
            font-size:22px;
            font-weight:bold;
        }

        .chat-container{
            width:80%;
            margin:20px auto;
            background:white;
            border-radius:10px;
            padding:20px;
            box-shadow:0 0 10px rgba(0,0,0,0.1);
        }

        .message{
            margin-bottom:15px;
            padding:10px;
            background:#f1f5f9;
            border-radius:8px;
        }

        .sender{
            font-weight:bold;
            color:#2563eb;
        }

        .form-chat{
            display:flex;
            gap:10px;
            margin-top:20px;
        }

        .form-chat input{
            flex:1;
            padding:10px;
        }

        .form-chat button{
            padding:10px 20px;
            background:#2563eb;
            color:white;
            border:none;
            cursor:pointer;
            border-radius:5px;
        }
    </style>
</head>

<body>

<div class="header">
    Group : {{ $group->name }}
</div>

<div class="chat-container">

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

    <form action="/group/send" method="POST" class="form-chat">

        @csrf

        <input
            type="hidden"
            name="group_id"
            value="{{ $group->id }}"
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

</div>

</body>
</html>