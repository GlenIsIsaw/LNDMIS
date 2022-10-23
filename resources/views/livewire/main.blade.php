<div>
    @include('livewire.menu')
    @if ($page == 'dashboard')
        @include('dashboard')
    @endif
    @if ($page == 'training')
        @include('trainings.index')
    @endif

    @if ($page == 'idp')
        @include('idp.index')
    @endif

    @if ($page == 'user')
        @include('users.index')
    @endif


</div>
