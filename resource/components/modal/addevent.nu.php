 <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="form-type" method="POST" onsubmit="return validateForm()">
                     <div class="form-group">
                         <label for="eventName">Nama Event</label>
                         <input type="text" class="form-control" id="eventName" placeholder="Enter event name" name="event" required>
                     </div>
                     <div class="form-group">
                         <label for="eventDesc">Keterangan</label>
                         <div class="grow-wrap">
                             <textarea class="form-control" id="eventDesc" rows="3" name="ket" onInput="this.parentNode.dataset.replicatedValue = this.value" required></textarea>
                         </div>
                         <input type="hidden" id="input-csrf" name="csrf" value="<?= App\core\Csrf::get(); ?>">
                     </div>
                     <div class="form-group mt-3 d-flex justify-content-between">
                         <button type="button" class="btn btn-secondary bg-danger" data-dismiss="modal">Cancel</button>
                         <button type="submit" class="btn btn-primary">Create Event</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 <script>
     function validateForm() {
         var x = document.forms["form-type"]["event"].value;
         if (x == "") {
             alert("Nama Event harus diisi");
             return false;
         }
         document.getElementById("form-type").action = "/home/addnew";
         return true;
     }
 </script>