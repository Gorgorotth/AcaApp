<form method="post"
      action="{{route('admin.garage.destroy', ['garage' => $garage->id])}}">
    @method('delete')
    @csrf
    <div class="modal fade" id="deleteModal{{$key}}"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Garage</h5>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger text-center">
                        DELETE GARAGE???
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">
                        <i>CANCEL</i>
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="entypo-trash">DELETE</i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>