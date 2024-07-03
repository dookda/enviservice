    <!-- Modal -->
        <div class="modal fade" id="myModalp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">สร้างใหม่</h4>
              </div>
              <div class="modal-body clearfix">
                    <div class="add_property">
                        <form role="form" id="add_property_form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            
                            <input type="text" name="title" class="form-control" placeholder="หัวข้อ">
                        </div>
                        <div class="form-group">
                            <input type="text" name="price" class="form-control" placeholder="ราคา">
                        </div>
                        <div class="form-group">
                            <input type="text" name="province" class="form-control" placeholder="จังหวัด">
                        </div>
                        <div class="form-group">
                            <textarea name="detail" class="form-control" rows="5" placeholder="รายละเอียด"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="file" name="file[]" id="file[]" multiple="multiple" placeholder="รูป"/>
                         </div>         
                        
                       
                    </div>
              </div>


               </form>
            </div>
          </div>
        </div>
	<!-- END Modal -->

  