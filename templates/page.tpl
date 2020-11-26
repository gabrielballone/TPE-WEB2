{if $cantCursos}
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center mt-5">

            {if $numPage > 1}
                <li class="page-item">
                    <a class="page-link" href="{$url}?{$filter}pagina={$numPage-1}">Anterior</a>
                </li>
            {/if}
            {for $i=1 to $amountPages}
                {if $i==$numPage}
                    <li class="page-item">
                    <p class="page-link text-dark">Pagina {$numPage}</p>
                </li>
                {else}
                <li class="page-item"><a class="page-link" href="{$url}?{$filter}pagina={$i}">{$i}</a></li>
                {/if}
            {/for}
            {if $numPage != $amountPages}
                <li class="page-item {if {$cantCursos < 4}}disabled{/if}">
                    <a class="page-link" href="{$url}?{$filter}pagina={$numPage+1}">Siguiente</a>
                </li>
                
            {/if}
        </ul>
    </nav>
    <p class="text-center mt-0">Total de cursos encontrados: {$amountCourses}</p> 
{/if}