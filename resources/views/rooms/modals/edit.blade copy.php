<div id="modal_edit_rooms" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Edit Rooms</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="EditRooms" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="id_rooms">
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Room Name</label>
                                <input type="text"class="form-control" required id="edit_name_room"
                                    name="edit_name_room">
                                <span id="error_name" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label">Capacity</label>
                                <input class="form-control" type="number" required name="edit_capacity_room"
                                    id="edit_capacity_room">
                                <span id="error_capacity" class="text-danger"></span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="form-label">Facility</label>
                                <input type="text" class="form-control" required id="edit_facility_room"
                                    name="edit_facility_room">
                                <span id="error_facility" class="text-danger"></span>
                                <div class="form-text">Ex: <code>Wifi, Projector, TV</code></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="form-label">Images</label>
                                <input type="file" id="edit_images_room" name="edit_images_room" class="form-control"
                                    accept="image/*">
                                <span id="error_images" class="text-danger"></span>
                            </div>

                            <div class="col-sm-6">
                                <img class="card-img img-fluid" id="view_images" style="height: 100px; width: 150px;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
        </div>
    </div>
</div>
