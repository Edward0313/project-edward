<div class="modal fade" id="upload-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">上傳圖片</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/admin/products/upload-image" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" id="product_id">
                <input type="file" name="product_image" id="product_image">
                <input type="submit" value="送出">
            </form>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="import" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="/admin/products/excel/import" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="excel" id="excel">
                <input type="submit" value="送出">
            </form>
        </div>
      </div>
    </div>
  </div>