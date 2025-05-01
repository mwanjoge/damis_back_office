<div class="col-xxl-6">
    <div class="card">
        <div class="">
            <div class="live-preview">
                <div>
                    <div class="card-body modal fade service-provider-modal" tabindex="-1" role="dialog"
                        aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" id="serviceProviderModal">
                            <div class="modal-content">
                                <div class="modal-body text-center p-5">
                                    <div class="mt-4">
                                        <h4 class="mb-3">New Service Provider</h4>
                                        <form action="">
                                            <div class="col-md-12 justify-content-center">
                                                <input type="text" class="form-control" id="validationDefault03" required>
                                            </div>
                                            <p class="mt-4">Services</p>
                                            
                                            <div id="services-container">
                                                
                                            </div>
                                            
                                            <a href="javascript:void(0);" class="btn btn-primary" wire:click="addService()">Add Service</a>
                                        </form>
                                        <div class="hstack gap-2 justify-content-center mt-4">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                            <a href="javascript:void(0);" class="btn btn-primary">SUBMIT</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
