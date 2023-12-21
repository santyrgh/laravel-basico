<!-- stilos para la tabla -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"> 
<style>
    #articulos {
      width: 100%;
      border-collapse: collapse;
    }

    #articulos th, #articulos td {
      text-align: center;
      padding: 8px; /* Ajusta el espaciado interno según sea necesario */
    }

    #articulos td img {
      display: block;
      margin: 0 auto; /* Centra horizontalmente la imagen */
    }

    /* Opcional: Si quieres centrar el contenido verticalmente */
    #articulos td {
      vertical-align: middle;
    }
  </style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                
            <a type="button" href="{{ route('productos.create') }}" class="btn btn-outline-primary">Crear</a>
            <table id="articulos"  class="table table-striped" style="width:100%">
    <thead class="bg-primary text-white">
                    <tr class="bg-gray-800 text-white">
                        <th style="display: none;">ID</th>
                        <th class="border px-4 py-2">NOMBRE</th>
                        <th class="border px-4 py-2">DESCRIPCION</th>
                        <th class="border px-4 py-2">IMAGEN</th>
                        <th class="border px-4 py-2">ACCIONES</th>
                    </tr>  
                </thead>    
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td style="display: none;">{{$producto->id}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td  class="border px-14 py-1">
                            <img src="/imagen/{{$producto->imagen}}"  width="100px">
                        </td>                        
                        <td class="border px-4 py-4">
                            <div class="flex justify-center rounded-lg text-lg" role="group">
                                <!-- botón editar -->
                                <a type="button" href="{{ route('productos.edit', $producto->id) }}"  class='btn btn-outline-warning w-18 h-10' >Editar</a>&nbsp &nbsp
                                <!-- botón borrar -->
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger ">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach   
                </tbody>  
                     
            </table>   
                <div>
                    {!! $productos->links() !!}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {        
          event.preventDefault()
          event.stopPropagation()        
          Swal.fire({
                title: '¿Confirma la eliminación del registro?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                }
            })                      
      }, false)
    })
})()
</script>
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script>
   $(document).ready(function() {
    $('#articulos').DataTable({
        scrollY: '700px',
        scrollCollapse: true,
        paging: true,
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        }
    });
});

</script>