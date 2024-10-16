let editar;
let btnEditar = false;

// Función para obtener los datos
const obtener_datos = () => {
    let tablaProducto = document.getElementById('tabla_productos');
    fetch("app/controller/obtener_datos.php")
    .then(respuesta => respuesta.json())
    .then((respuesta) => {
        let contenido = ''; 
        respuesta.map((dato) => {
            contenido += `
            <tr>
                <td>${dato['nombre']}</td>
                <td>${dato['apellido']}</td>
                <td>${dato['year_ingreso']}</td>
                <td>${dato['carrera']}</td>
                <td>${dato['year_nacimiento']}</td>
                <td>
                    <button class="btn btn-primary me-3 editar" data-btn="editar" 
                        data-id="${dato['id']}" 
                        data-nombre="${dato['nombre']}" 
                        data-apellido="${dato['apellido']}" 
                        data-ingreso="${dato['year_ingreso']}" 
                        data-carrera="${dato['carrera']}" 
                        data-nacimiento="${dato['year_nacimiento']}">
                        Editar <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger eliminar" data-btn="eliminar" data-id="${dato['id']}">
                        Eliminar <i class="bi bi-trash3-fill"></i>
                    </button>
                </td>
            </tr>
            `;
        });
        tablaProducto.innerHTML = contenido;
    });
}

// Función para registrar producto
const registrar_producto = () => {
    let nombre_a = document.getElementById('nombre').value;
    let apellido_a = document.getElementById('apellido').value;
    let ingreso_a = document.getElementById('ingreso').value;
    let carrera_a = document.getElementById('carrera').value;
    let nacimiento_a = document.getElementById('nacimiento').value;

    let data = new FormData();
    data.append("nombre_alumno", nombre_a); 
    data.append("apellido_alumno", apellido_a); 
    data.append("year_ingreso_alumno", ingreso_a);
    data.append("carrera_alumno", carrera_a);
    data.append("year_nacimiento_alumno", nacimiento_a);

    fetch("app/controller/registro_productos.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success", title: `${respuesta[1]}`});
            obtener_datos();
            limpiar_formulario();
        } else {
            Swal.fire({icon: "error", title: `${respuesta[1]}`});
        }
    })
}

// Función para editar producto
const editar_producto = () => {
    let nombre_a = document.getElementById('nombre').value;
    let apellido_a = document.getElementById('apellido').value;
    let ingreso_a = document.getElementById('ingreso').value;
    let carrera_a = document.getElementById('carrera').value;
    let nacimiento_a = document.getElementById('nacimiento').value;

    let data = new FormData();
    data.append('idInput', editar);
    data.append("nombre_alumno", nombre_a); 
    data.append("apellido_alumno", apellido_a); 
    data.append("year_ingreso_alumno", ingreso_a); 
    data.append("carrera_alumno", carrera_a); 
    data.append("year_nacimiento_alumno", nacimiento_a);

    fetch("app/controller/actualizar_producto.php", {
        method: "POST",
        body: data
    })
    .then(res => res.json())
    .then(async (res) => {
        if (res[0] == 1) {
            await Swal.fire({icon: "success", title: `${res[1]}`});
            obtener_datos();
            btnEditar = false;
            limpiar_formulario();
        } else {
            Swal.fire({icon: "error", title: `${res[1]}`});
        }
    });
}

// Función para eliminar producto
const eliminar_producto = () => {
    let data = new FormData();
    data.append('idInput', editar);

    fetch("app/controller/eliminar_producto.php", {
        method: "POST",
        body: data
    })
    .then(respuesta => respuesta.json())
    .then(async respuesta => {
        if (respuesta[0] == 1) {
            await Swal.fire({icon: "success", title: `${respuesta[1]}`});
            obtener_datos();
        } else {
            await Swal.fire({icon: "error", title: `${respuesta[1]}`});
        }
    });
}

// Limpia los campos del formulario
const limpiar_formulario = () => {
    document.getElementById('nombre').value = '';
    document.getElementById('apellido').value = '';
    document.getElementById('ingreso').value = '';
    document.getElementById('carrera').value = '';
    document.getElementById('nacimiento').value = '';
}

// Manejador de eventos
document.addEventListener('DOMContentLoaded', () => {
    obtener_datos();
});

document.getElementById('btn-registrar-producto').addEventListener('click', () => {
    if (!btnEditar) {
        registrar_producto();
    } else {
        editar_producto();
    }
});

document.getElementById('tabla_productos').addEventListener('click', (e) => {
    if (e.target.classList.contains('editar')) {
        document.getElementById('nombre').value = e.target.dataset.nombre;
        document.getElementById('apellido').value = e.target.dataset.apellido;
        document.getElementById('ingreso').value = e.target.dataset.ingreso;
        document.getElementById('carrera').value = e.target.dataset.carrera;
        document.getElementById('nacimiento').value = e.target.dataset.nacimiento;

        document.getElementById('btn-registrar-producto').textContent = 'Editar Producto';

        editar = e.target.dataset.id;
        btnEditar = true;
    }
    if (e.target.classList.contains('eliminar')) {
        editar = e.target.dataset.id;
        eliminar_producto();
    }
});
