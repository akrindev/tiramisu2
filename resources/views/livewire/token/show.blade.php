<div class="card mt-5">
    <div class="card-header">
        <h3 class="card-title">API token for Developer</h3>
    </div>

    <div class="card-body">
        <p>You can use token to access toram id public API.</p>
        <a href="/developer">Read documentation here</a>
    </div>

    <div class="card-footer">
        @if (! $this->token)
        <button class="btn btn-primary btn-full" wire:click="generateNewToken">generate token</button>
        @else
        <input type="text" class="form-control" disabled value="{{ $this->token->plain_token }}">
        @endif

    </div>
</div>
