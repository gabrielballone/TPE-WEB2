{if $showFilter}
    <h1 class="my-4">Filtrar por</h1>
    <form id="formFilterCourses" method="GET" action="{$urlFilter}">
        <div class="input-group mb-3">
            <select class="custom-select" name="filtro" id="filtro">
                <option value="sinfiltro" {if $datos['filtro']}selected{/if}>Sin filtro</option>        
                <option value="nombre"{if $datos['filtro'] == 'nombre'}selected{/if}>Nombre</option>
                <option value="duracion"{if $datos['filtro'] == 'duracion'}selected{/if}>Duración</option>
                <option value="precio"{if $datos['filtro'] == 'precio'}selected{/if}>Precio</option>
            </select>
        </div>
        <div id="searchText" class="input-group mb-3 d-none">
            <input id="texto" name="texto" type="text" placeholder="Busqueda..." class="w-100" {if $datos['filtro'] == 'nombre'}value="{$datos['texto']}"{/if}/>
        </div>
        <div id="searchNumber" class="input-group mb-3 d-none">
            <input id="min" name="min" type="number" placeholder="Minimo" class="w-50" {if $datos['filtro'] == 'duracion' || $datos['filtro'] == 'precio'}value="{$datos['min']}"{/if}/>
            <input id="max" name="max" type="number" placeholder="Maximo" class="w-50" {if $datos['filtro'] == 'duracion' || $datos['filtro'] == 'precio'}value="{$datos['max']}"{/if}/>
        </div>
        <button type="submit" class="btn btn-success btn-block">Filtrar</button>
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