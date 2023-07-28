<div id="modal_rooms" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Rooms</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="rooms" action="#">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Room Name</label>
                                <input type="text"class="form-control" required id="name_room" name="name_room">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Capacity</label>
                                <input class="form-control" type="number" required name="capacity_room"
                                    id="capacity_room">
                                <span id="error_capacity" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Facility</label>
                                <input type="text" class="form-control" required id="facility_room"
                                    name="facility_room">
                                <span id="error_facility" class="text-danger"></span>
                                <div class="form-text">Ex: <code>Wifi, Projector, TV</code></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Images</label>
                                <input type="file" id="images_room" name="images_room" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="save" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
