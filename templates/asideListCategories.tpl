{if $showFilter}
    <h1 class="my-4">Filtrar por</h1>
    <form id="formFilterCourses" method="GET" action="{$urlFilter}">
        <div class="input-group mb-3">
            <label class="input-group-text" for="orden">Orden</label>
            <select class="custom-select" name="orden" id="orden">
                <option value="asc" selected>Ascendente</option>
                <option value="desc">Descendente</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <select class="custom-select" name="filtro" id="filtro">
                <option value="sinfiltro" selected>Sin filtro</option>
                <option value="nombre">Nombre</option>
                <option value="duracion">Duracion</option>
                <option value="precio">Precio</option>
            </select>
            <button type="submit" class="btn btn-success w-25">Filtrar</button>
        </div>
    </form>
{/if}

<h1 class="my-4">Categorías</h1>
<div class="accordion" id="accordionExample">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">
                <a href="cursos" class="btn btn-link btn-block text-left {if $idSelected eq "Todos"}font-weight-bold{/if}" role="button" type="button">
                    Todos los cursos
                </a>
            </h2>
        </div>
    </div>
    {foreach from=$categories item=$category}
        <div class="card">
            <div class="card-header" id="heading{$category->id}">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse{$category->id}" aria-expanded="false" aria-controls="collapse{$category->id}">
                        <a href="categorias/{$category->id}" class="{if $category->id eq $idSelected}font-weight-bold{/if}">{$category->nombre}</a>
                    </button>
                </h2>
            </div>
            <div id="collapse{$category->id}" class="collapse {if $category->id eq $idSelected}show{/if}" aria-labelledby="heading{$category->id}" data-parent="#accordionExample">
                <div class="card-body">
                    {$category->descripcion}
                </div>
            </div>
        </div>
    {/foreach}
</div>