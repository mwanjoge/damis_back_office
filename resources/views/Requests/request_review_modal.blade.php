 <!-- Document Preview Modal -->
 @include('requests.request_rejection_modal')
 <div class="modal fade" id="documentPreviewModal" tabindex="-1" aria-labelledby="documentPreviewLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="documentPreviewLabel">Document Preview</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <!-- Modal body with spinner and iframe -->
             <div class="modal-body d-flex position-relative">
                 <!-- Spinner overlay -->
                 <div id="preview-loading"
                     class="position-absolute top-50 start-50 translate-middle text-center bg-white bg-opacity-75 p-4 rounded shadow"
                     style="z-index: 10; display: none;">
                     <div class="spinner-border text-primary" role="status">
                         <span class="visually-hidden">Loading...</span>
                     </div>
                     <p class="mt-2">Loading preview...</p>
                 </div>

                 <!-- PDF iframe -->
                 <iframe id="preview-frame" style="width: 60%; height: 600px; border: 1px solid #ccc; z-index: 1;"
                     src=""></iframe>

                 <!-- Certificate details and buttons -->
                 <div style="width: 30%; padding-left: 20px;">
                     <div id="document-details" style="margin-bottom: 20px;"></div>
                 </div>
             </div>
             <!-- Modal footer with form-based Approve/Reject buttons -->
             <div class="modal-footer border-0">
                 <form method="POST" id="reject-form" class="me-2">
                     @csrf
                     <button type="button" class="btn btn-outline-danger rounded-pill px-4 reject-button"
                         data-item-id="123">
                         Reject
                     </button>
                 </form>

                 <form method="POST" id="approve-form">
                     @csrf
                     <button type="submit" class="btn btn-success rounded-pill px-4">Approve</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
 </div>

 <script>
     let selectedItemId = null;

     function previewDocument(url, holderName, indexNumber, itemId, serviceName, serviceProvider) {
         selectedItemId = itemId;

         // Fill in certificate info
         document.getElementById('document-details').innerHTML = `
            <div class="card shadow-sm border-0">
                <div class="card-body">
                <h5 class="card-title mb-3 text-primary">Certificate Information</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><strong>Service Name:</strong> ${serviceName}</li>
                    <li class="mb-2"><strong>Service Provider:</strong> ${serviceProvider}</li>
                    <li class="mb-2"><strong>Certificate Holder:</strong> ${holderName}</li>
                    <li><strong>Document Number:</strong> ${indexNumber}</li>
                </ul>
                </div>
            </div>
            `;

         // Update form actions
         document.getElementById('approve-form').action = `/request/approve/${itemId}`;
         //  document.getElementById('reject-form').action = `/requests/reject/${itemId}`;

         const iframe = document.getElementById('preview-frame');
         const spinner = document.getElementById('preview-loading');

         iframe.style.visibility = 'hidden';
         iframe.src = '';
         spinner.style.display = 'block';

         const modalEl = document.getElementById('documentPreviewModal');
         const modal = new bootstrap.Modal(modalEl);
         modal.show();

         modalEl.addEventListener('shown.bs.modal', function onShown() {
             modalEl.removeEventListener('shown.bs.modal', onShown);

             setTimeout(() => {
                 iframe.src = url;
             }, 100);

             iframe.onload = () => {
                 spinner.style.display = 'none';
                 iframe.style.visibility = 'visible';
             };
         });
     }

     document.addEventListener("DOMContentLoaded", function() {
         const rejectForm = document.getElementById("reject-form");
         const rejectComment = document.getElementById("reject-comment");
         const rejectItemIdField = document.getElementById("reject-item-id");

         function openRejectModal(itemId) {
             const reviewModalEl = document.getElementById("documentPreviewModal");
             const reviewModal = bootstrap.Modal.getInstance(reviewModalEl);
             reviewModal.hide();

             rejectItemIdField.value = itemId;
             const modalEl = new bootstrap.Modal(document.getElementById("rejectConfirmationModal"));
             modalEl.show();
         }

         // Attach event listener to reject buttons dynamically
         document.querySelectorAll(".reject-button").forEach(button => {
             button.addEventListener("click", function() {
                 const itemId = this.dataset.itemId;
                 openRejectModal(itemId);
             });
         });

         // Validate rejection comment before submission
         rejectForm.addEventListener("submit", function(event) {
             if (!rejectComment.value.trim()) {
                 event.preventDefault();
                 alert("Please provide a reason for rejection.");
             }
         });
     });
 </script>
