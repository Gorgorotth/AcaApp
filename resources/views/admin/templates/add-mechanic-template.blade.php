<template id="add-garage-mechanic">
    <div class="row my-2 deleteContent">
        <button type="button" class="btn btn-close pt-3 col-md-1 add-to-garage-close-btn"></button>
        <label for="garage-mechanic" class="col-sm-2 col-form-label">Mechanic:</label>
        <div class="col-sm-9">
            <select class="form-select add-to-garage" name="addMechanicToGarage" id="garage-mechanic" required>
                <option>---Select Mechanic---</option>
               @foreach($unemployedMechanics as $mechanic)
                <option value="{{$mechanic->id}}">{{$mechanic->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</template>