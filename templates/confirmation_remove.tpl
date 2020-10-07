{include file="templates/navbar.tpl"}
<div class="container">
    <div class="text-center">
        <h1 class="mb-4">Eliminar {$entityToRemove}</h1>
        <div>
            <p class="h3 mb-4">¿Está seguro que desea eliminar "{$name}"?</p>
        </div>
        <div class="mb-4">
            <a href="{$entityToRemove}/eliminar/{$id}" class="btn btn-danger">Eliminar</a>
            <a href="{$entityToRemove}/administrar" type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</a>
        </div>
    </div>          
</div>
{include file="templates/footer.tpl"}