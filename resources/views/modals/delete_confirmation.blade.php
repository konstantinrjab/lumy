<div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" id="js-deleteForm" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="formSubmit()">Delete</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script type="text/javascript">
        function confirmDelete(url, id) {
            let deleteUrl = url + '/' + id;
            console.log(deleteUrl);
            $("#js-deleteForm").attr('action', deleteUrl);
        }

        function formSubmit() {
            $("#js-deleteForm").submit();
        }
    </script>
@endpush
