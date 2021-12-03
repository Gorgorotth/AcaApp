<template id="add-garage-mechanic">
    <div class="form-group deleteContent">
        <div class="row">
            <span class="cursor-pointer entypo-cancel add-to-garage-close-btn"></span>
            <div class="col-sm-10">
                <select class="form-control add-to-garage" name="addMechanicToGarage" id="garage-mechanic" required>
                    <option>---Select Mechanic---</option>
                    @foreach($unemployedMechanics as $mechanic)
                        <option value="{{$mechanic->id}}">{{$mechanic->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</template>