<!-- Modal -->

<div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit New Item</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <form action="#" action="POST" id="edit_item_form" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="item_id" id="item_id">
            <input type="hidden" name="item_image" id="item_image">
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Title" >
                        <span class="text-danger error-text name_error"></span> 
                    </div>
                    <div class="my-2">
                        <label for="image">Select Image</label>
                        <input type="file" name="image" class="form-control" >
                        <span class="text-danger error-text image_error"></span>
                    </div>
                    <div class="mt-2" id="image">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
        
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="edit_item_btn" class="btn btn-primary">Edit Item</button>
              </div>
        </form>
      
      </div>
    </div>
  </div>