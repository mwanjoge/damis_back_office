<div style="align: center;">
   <img src="{{ asset('images/emblem.png') }}" alt="Logo" style="width: 100px; height: auto;" />
    <h3 style="text-align: center; background-color:#eee">Legalisation request successful created</h3>
    <p style="text-align: center;">Hello {{ $request->member?->name}} your rquest for document legalisation has beeen successful created and 
        <strong>{{ getTrackNumber([$request->id])}}</strong> is your tracking number for status follow up. use it to get your request status
    </p>
</div>