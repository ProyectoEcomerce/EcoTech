@extends('layouts.plantilla')

@section('title', "Productos")

@section('content')

<div class="container my-5">
    <div class="row justify-content-center mb-4">
        <div class="col-lg-6 col-md-12">
            <div class="card border-0">
                <img src="{{ asset('img/almacen-dia.png') }}" class="card-img-top img-fluid" alt="Productos">
            </div>
        </div>
        <div class="col-lg-6 col-md-12">
            <div class="card bg-light border-0">
                <div class="card-body">
                    <h5 class="card-title">Nombre del Producto</h5>
                    <p class="card-text">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Temporibus labore, ipsa quaerat cumque, fugiat nemo consectetur voluptatibus maiores aliquam corporis quia veniam fugit et corrupti quis nostrum magnam assumenda ut.                        
                        <br><br>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus quaerat reiciendis deserunt ut error saepe facere at, eligendi quia laboriosam. Minus minima ipsa quo repudiandae cupiditate possimus placeat facere ut?
                    </p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" id="boton-card" type="button">Agregar a la cesta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <h5 class="card-title">Componentes del Producto</h5>
                    <p>XXXX:</p> 
                    <p>XXXX:</p>   
                    <p>XXXX:</p>
                    <p>XXXX:</p>   
                    <p>XXXX:</p>   
                    <p>XXXX:</p>   
                    <p>XXXX:</p>   
                    <p>XXXX:</p>   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
