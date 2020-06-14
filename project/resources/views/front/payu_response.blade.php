@extends('layouts.front')


@section('content')

<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="pages">
                    <li>
                        <a href="{{ route('front.index') }}">
                            {{ $langg->lang17 }}
                        </a>
                    </li>
                    <li>
                        <a href="#">
                           Transaccion PayU Latam
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->

<section style="padding: 30px 0px 50px;">
    <div class="container">
        @if (strtoupper($response['signature']) == strtoupper($response['firmacreada']))
               <div class="row">
                   <div class="col-xs-12 col-md-12 col-lg-12">
                       <h3>Resumen Transacción PayU Latam</h3>
                   <table class="table table-striped">
                       <tr>
                       <td class="font-weight-bold">Estado de la transaccion</td>
                       <td>{{ $response['transactionStateText'] }}</td>
                       </tr>
                       <tr>
                       <tr>
                       <td class="font-weight-bold">ID de la transaccion</td>
                       <td>{{ $response['transactionId'] }}</td>
                       </tr>
                       <tr>
                       <td class="font-weight-bold">Referencia de la venta</td>
                       <td>{{ $response['reference_pol'] }}</td>
                       </tr>
                       <tr>
                       <td class="font-weight-bold">Referencia de la transaccion</td>
                       <td>{{ $response['referenceCode'] }}</td>
                       </tr>
                       <tr>
                       @if(isset($response['pseBank']) && $response['pseBank'] != null)
                           <tr>
                           <td class="font-weight-bold">cus </td>
                           <td>{{ $response['cus'] }} </td>
                           </tr>
                           <tr>
                           <td class="font-weight-bold">Banco </td>
                           <td>{{ $response['pseBank'] }} </td>
                           </tr>
                       @endif
                       <tr>
                       <td class="font-weight-bold">Valor total</td>
                       <td>${{number_format($response['TX_VALUE'])}}</td>
                       </tr>
                       <tr>
                       <td class="font-weight-bold">Moneda</td>
                       <td>{{ $response['currency'] }}</td>
                       </tr>
                       <tr>
                       <td class="font-weight-bold">Descripción</td>
                       <td>{{ $response['description'] }}</td>
                       </tr>
                       <tr>
                       <td class="font-weight-bold">Entidad:</td>
                       <td>{{ $response['lapPaymentMethod'] }}</td>
                       </tr>
                   </table>
                   </div>
   
                   <div class="col-md-12 col-xs-12 col-lg-12 text-center">
                       <a href="{{route('front.index')}}" class="btn btn-primary btn-lg">Seguir Comprando</a>
                   </div>
               </div>
           @else
               <h1>Error validando firma digital.</h1>
   
           @endif
   </div>
</section>

@endsection