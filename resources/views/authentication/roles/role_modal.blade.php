<!-- Role Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="roleForm" method="POST" action="#">
          @csrf
          <input type="hidden" name="_method" id="_method_field" value="POST">
          <input type="hidden" name="role_id" id="roleId" value="">
  
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="roleModalLabel">Role</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
  
              <div class="modal-body">
                  <div class="mb-3">
                      <label for="roleName" class="form-label">Role Name</label>
                      <input type="text" class="form-control" id="roleName" name="name" required>
                  </div>
              </div>
  
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save Role</button>
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              </div>
          </div>
      </form>
    </div>
  </div>
  