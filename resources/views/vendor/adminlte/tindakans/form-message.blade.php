@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.pengajuan.postMessage',[$pengajuan->id]) }}" class="form-create-pengajuan" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row mb-3">
        <div class="col-xs-12 col-sm-12 col-lg-812 mb-3">
			<div class="card card-primary">
				<div class="card-body">
                    <div class="chat-box">
                        <div class="chat-messages" style="min-height: 300px; max-height: 340px; overflow-y: auto;">
                            <!-- Chat messages will appear here -->
                        </div>
                        <div class="chat-input mt-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type a message..." id="chatMessage">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary" id="sendChat">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
        </div>
    </div>

</form>


    <style>
        .chat-messages {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
        }

        .chat-message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .chat-message.user {
            background: #007bff;
            color: #fff;
            text-align: right;
        }

        .chat-message.other {
            background: #e9ecef;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#sendChat').on('click', function() {
                let message = $('#chatMessage').val();
                if (message.trim() !== '') {
                    $('.chat-messages').append(`
                        <div class="chat-message user">${message}</div>
                    `);
                    $('#chatMessage').val('');
                    // Scroll to bottom
                    $('.chat-messages').scrollTop($('.chat-messages')[0].scrollHeight);
                }
            });
        });
    </script>