<!-- Modal -->

<div class="modal fade" id="addItemsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Item</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
       
        <form action="#" action="POST" id="add_item_form" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Title" >
                        <span class="text-danger error-text name_error"></span> 
                    </div>
                    <div class="my-2">
                        <label for="image">Select Image</label>
                        <input type="file" name="image" class="form-control" >
                        <span class="text-danger error-text image_error"></span>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
        
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="add_item_btn" class="btn btn-primary">Add Item</button>
              </div>
        </form>
      
      </div>
    </div>
  </div>