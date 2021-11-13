<div>
     @include('sweetalert::alert')
     <div class="card">
          <div class="card-body">
               <div class="col-md-12">
                    <div class="card card-body">

                         <form wire:submit.prevent="categoryStore">
                              <div class="row">
                                   <div class="col-md-6">
                                        <label for="">Category Name</label>
                                        <input type="text" wire:model="name" class="form-control">
                                        @error('name') <span class="text-danger">{{$message}}</span>@enderror
                                   </div>
                                   <div class="col-md-6">
                                        <label>Banner</label>
                                        <input type="file" wire:model="banner" class="form-control">
                                        @error('banner') <span class="text-danger">{{$message}}</span> @enderror


                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-md-6">
                                        <label for="">Ordering Number</label>
                                        <input type="number" wire:model="order_by" class="form-control">
                                   </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="">Parent Category</label>
                                             <select wire:model="parent_id"  class="form-control select2 selectpicker" style="width: 100%;">
                                                  <option value="0">Select</option>
                                                  @foreach($mainlist as $main)
                                                  <option value="{{$main->id}}">{{$main->title}}</option>
                                                  @foreach($parent as $parents)
                                                  @if($parents->parent_id == $main->id)
                                                  <option value="{{$parents->id}}">&nbsp;&nbsp;&nbsp;-{{$parents->title}}</option>
                                                  @foreach($ultraparent as $ultraparents)
                                                  @if($ultraparents->parent_id == $parents->id)
                                                  <option value="{{$ultraparents->id}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{$ultraparents->title}}</option>
                                                  @endif
                                                  @endforeach
                                                  @endif
                                                  @endforeach
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                              </div>
                              <br>
                              <div class="row">
                                   <div class="col-md-6">
                                        <a class="btn bg-indigo btn-sm " href="{{'category-list'}}">Back</a>
                                        <button type="submit" class="btn btn-info btn-sm  btn-flate">Save
                                             Category</button>
                                   </div>

                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
<script>
     $(function() {
          //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
               theme: 'bootstrap4'
          })
     });
</script>