@php
    $amount = $data['total'] * $curr->value;
    $amount = number_format($amount,0,".","");
    $tax = $amount * ($gs->tax / 100);
    $tax = number_format($tax,0,".","");
    $taxReturnBase = $tax > 0 ? ($amount - $tax) : 0;
    $referenceCode = $data['referenceCode'];
    $signature = \Helper::buildSignaturePayU($gs->payu_apikey,$gs->payu_merchantid,$referenceCode,$amount);
    $description = $data['description'];
    $redirect = $gs->payu_sandbox == 1 ? 'https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu' : 'https://checkout.payulatam.com/ppp-web-gateway-payu';
@endphp
<form action="{{$redirect}}" id="form_payu" method="POST">
    <input name="merchantId"    type="hidden"  value="{{$gs->payu_merchantid}}"   >
    <input name="accountId"     type="hidden"  value="{{$gs->payu_accountid}}" >
    <input name="description"   type="hidden"  value="{{$description}}"  >
    <input name="tax" type="hidden"  value="{{$tax}}" >
    <input name="referenceCode" type="hidden"  value="{{$referenceCode}}" >
    <input name="amount"        type="hidden"  value="{{$amount}}"   >
    <input name="taxReturnBase" type="hidden"  value="{{$taxReturnBase}}" >
    <input name="currency"      type="hidden"  value="COP" >
    <input name="signature"     type="hidden"  value="{{$signature}}"  >
    <input name="test"          type="hidden"  value="{{$gs->payu_sandbox}}" >
    <input name="buyerFullName"    type="hidden"  value="{{Auth::user()->name}}" >
    <input name="buyerEmail"    type="hidden"  value="{{Auth::user()->email}}" >
    <input name="responseUrl"    type="hidden"  value="{{route('payu.notify')}}" >
    <input name="confirmationUrl"    type="hidden"  value="{{route('payu.confirm')}}" >
</form>

<script src="{{asset('assets/front/js/jquery.js')}}"></script>

<script>
    $(document).ready(function (){
        setTimeout(() => {
            $('#form_payu').submit();
        }, 300);
    })
</script>