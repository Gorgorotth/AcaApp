<form method="post"
      action="{{route('admin.garage-delete', ['garageId' => $garage->id])}}">
    @csrf
    <div class="modal fade" id="deleteModal{{$key}}" tabindex="-1"
         aria-labelledby="deleteModal{{$key}}"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Garage</h5>
                    <button type="button" class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        DELETE GARAGE???
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        CANCEL
                    </button>
                    <button type="submit" class="btn btn-primary">DELETE
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>