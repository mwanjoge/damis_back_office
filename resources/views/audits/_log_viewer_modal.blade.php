<div class="modal fade" id="log-viwer-modal-{{ $audit->id }}" tabindex="-1" aria-labelledby="documentPreviewLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="log-viwer-modal-{{ $audit->id }}">Log Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body with spinner and iframe -->
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Old Values
                            </div>
                            <div class="card-body">
                                <h4>Requested URL</h4>
                                <div>
                                    <pre><code><a class="text-reset" target="_blank" href="https://preview.tabler.io">{{$audit->url}}</a></code></pre>
                                </div>
                                <h4>Affected Data</h4>
                                <div class="">
                                    <pre class="">
                                        <span class="float-start m-0">IP ADRESS: {{ $audit->ip_address }}</span>
                                        @foreach ($audit->old_values as $key => $value)
                                            <span class="float-start m-0">{{ $key }}: {{ $value }}</span>
                                        @endforeach 
                                    </pre>
                                </div>
                                <h4>Device</h4>
                                <div>
                                    <pre>{{ $audit->user_agent }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                New Values
                                <span class="text-end text-uppercase badge bg-azure-lt">{{ $audit->event }}</span>
                            </div>
                            <div class="card-body">
                                <h4>Requested URL</h4>
                                <div>
                                    <pre><code><a class="text-reset" target="_blank" href="https://preview.tabler.io">{{$audit->url}}</a></code></pre>
                                </div>
                                <h4>Affected Data</h4>
                                <div class="">
                                    <pre class="">
                                        <span class="float-start m-0">IP ADRESS: {{ $audit->ip_address }}</span>
                                        @foreach ($audit->new_values as $key => $value)
                                            <span class="float-start m-0">{{ $key }}: {{ $value }}</span>
                                        @endforeach 
                                    </pre>
                                </div>
                                <h4>Device</h4>
                                <div>
                                    <pre>{{ $audit->user_agent }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
