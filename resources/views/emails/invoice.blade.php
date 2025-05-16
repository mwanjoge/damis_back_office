<div style="align: center;">
   <img src="{{ asset('images/emblem.png') }}" alt="Logo" style="width: 100px; height: auto;" />
    <h1 style="text-align: center; background-color:#eee">Invoice {{ $invoice->ref}}</h1>
    <p style="text-align: center;">Hello {{ $invoice->member->name}} your invoice has been created please pay to continue with you request</p>
    <h2>INVOICE DETAILS</h2>
    <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 8px;">Item</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Description</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->generalLineItems as $item)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->service->name }}</td>
                    {{-- <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->description }}</td> --}}
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
</div>