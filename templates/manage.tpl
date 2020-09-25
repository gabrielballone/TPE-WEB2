{include file="templates/navbar.tpl" BASE_URL=BASE_URL}
<div class="container">
    <h1 class="text-center">Administrar</h1>
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin mb-5">
                <div class="card-body">
                    <h5 class="card-title text-center">{$title}</h5>
                    {if !$objectEntity}
                        <form class="form-signin" action="{$entityName}/nuevo" method="POST">
                            {foreach key=$key from=$arrayEntity[0] item=$item}            
                            {if !$item@first}
                                {if $key eq "id_categoria"}
                                    <label for="selectCategoria">Categoría</label>
                                    <select class="form-control mb-2" name="selectCategoria">
                                        {foreach from=$arrayRelatedEntity item=$category}
                                            <option value="{$category->id}">{$category->nombre}</option> 
                                        {/foreach}
                                    </select>
                                {else}
                                    <label for="{$key}">{$key|capitalize}</label>
                                    <input name="{$key}" type="text" class="form-control mb-2" required>
                                {/if}
                            {/if}
                            {/foreach}
                            <button class="btn btn-lg btn-success btn-block mb-2" type="submit">Agregar</button>
                        </form>
                    {else}                        
                        <form class="form-signin" action="{$entityName}/modificar/{$objectEntity->id}" method="POST">
                            {foreach key=$key from=$arrayEntity[0] item=$item}           
                            {if !$item@first}
                                {if $key != "id_categoria"}
                                 <label for="{$key}">{$key|capitalize}</label>
                                 <input name="{$key}" type="text" class="form-control mb-2" value="{$objectEntity->$key}" required>
                                {else if $key eq "id_categoria"}
                                    <label for="selectCategoria">Categoría</label>
                                    <select class="form-control mb-2" name="selectCategoria">
                                        {foreach from=$arrayRelatedEntity item=$category}
                                            {if $objectEntity->id_categoria == $category->id}
                                                <option value="{$category->id}" selected>{$category->nombre}</option> 
                                            {else}
                                                <option value="{$category->id}">{$category->nombre}</option> 
                                            {/if}
                                        {/foreach}
                                    </select>
                                {/if}
                            {/if}
                            {/foreach}
                            <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Modificar</button>
                            <a href="{$entityName}/administrar" class="btn btn-lg btn-danger btn-block mb-2">Cancelar</a>
                        </form>
                    {/if}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <table class="table">
            <thead class="thead-dark">
                <tr>
                    {foreach key=$key from=$arrayEntity[0] item=$item}
         
                        {if !$item@first}
                            <th scope="col">{$key|capitalize}</th>
                        {/if}
                    {/foreach}
                    <th scope="col">Editar</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$arrayEntity item=$itemArray}
                    <tr>
                        {foreach key=$key from=$itemArray item=$item}
                            {if !$item@first}
                            <td>
                                {if $key == "id_categoria"}
                                    {foreach from=$arrayRelatedEntity item=$category}
                                        {* si el id de la categoria es igual al id del curso *}
                                        {if $category->id == $objectEntity->categoria_id}
                                            {$category->nombre}
                                        {/if}
                                    {/foreach}
                                {else}
                                    {$item}
                                {/if}
                                {* {$item} *}
                            </td>
                            {/if}
                        {/foreach}
                        <td><a href="{$entityName}/modificar/{$itemArray->id}"><img src="images/editar.png" alt="editar"/></a></td>
                        <td><a href="{$entityName}/eliminar/{$itemArray->id}"><img src="images/eliminar.png" alt="eliminar"/></a></td>
                    </tr>
                {/foreach}
            </tbody>
        </table>







        </div>
    </div>
</div>

{include file="templates/footer.tpl"}