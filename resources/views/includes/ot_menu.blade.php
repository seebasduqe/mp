<div class="card-header card-header-tab-animation">
    <ul class="nav">

        <li class="nav-item"><a href="{{ route('ot.edit_common_data', $ot_id) }}"
                class="@if ($active == 'common_data') active @endif nav-link">Información común</a></li>

        <li class=" nav-item"><a href="{{ route('ot.edit_articles', $ot_id) }}"
                class="@if ($active == 'articles') active @endif nav-link">Artículo</a></li>

        <li class=" nav-item"><a href="{{ route('ot.edit_materials', $ot_id) }}"
                class="@if ($active == 'materials') active @endif nav-link">Materiales</a></li>


        <li class=" nav-item"><a href="{{ route('ot.edit_hours', $ot_id) }}"
                class="@if ($active == 'hours') active @endif nav-link">Horas</a></li>

        <li class=" nav-item"><a href="{{ route('ot.edit_documents', $ot_id) }}"
                class="@if ($active == 'documents') active @endif nav-link">Documentos</a></li>

    </ul>

</div>
