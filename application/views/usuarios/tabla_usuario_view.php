<div class="panel panel-info">
    <div class="panel-heading">Usuarios</div>
    <div class="panel-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($usuarios as $fila):
            ?>
                <tr>
                    <td id = ><?=$fila->nombre?></td>
                    <td><?=$fila->apellidos?></td>
                    <td><?=$fila->usuario?></td>
                    <td><?=$fila->email?></td>
                    <td><button type="button"  id = "<?=$fila->idUsuario?>" class="btn btn-warning editar">Editar</button></td>
                    <td><button type="button"  id = "<?=$fila->idUsuario?>" class="btn btn-danger eliminar">Eliminar</button></td>
                </tr>
            <?php
            endforeach;
            ?>
            </tbody>
        </table>
    </div>
</div>