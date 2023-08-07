@extends("layouts.base")

@section("title", "Dashboard")


@section("content")
    @include("partials.admin_topbar_inc")
    <div class="container">
        @livewire("user-crud")

    </div>
@endsection

@section("extra_js")
    <script>
        window.addEventListener('close-new-customer-modal', () => {
            $("#userCrudModal").modal("hide")
        })

        window.addEventListener('open-update-customer-modal', () => {
            $("#updateDetails").modal("show")
        })

        window.addEventListener('close-update-customer-modal', () => {
            $("#updateDetails").modal("hide")
        })

        window.addEventListener('close-delete-modal', () => {
            $("#deleteModal").modal("hide")
        })
         window.addEventListener('show-delete-modal', () => {
            $("#deleteModal").modal("show")
        })
    </script>
@endsection
