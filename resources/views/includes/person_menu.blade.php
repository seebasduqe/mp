<div class="card-header card-header-tab-animation">
    <ul class="nav">

        <li class="nav-item"><a href="{{ route('persons.edit_personal_data', $person_id) }}"
                class="@if ($active == 'personal_data') active @endif nav-link">Información personal</a></li>

        <li class=" nav-item"><a href="{{ route('persons.edit_tax_social_data', $person_id) }}"
                class="@if ($active == 'tax_social_data') active @endif nav-link">Bancos y
                otros</a></li>

        <li class=" nav-item"><a href="{{ route('persons.edit_document', $person_id) }}"
                class="@if ($active == 'documents') active @endif nav-link">Documentos</a></li>

        <li class=" nav-item"><a href="{{ route('persons.edit_cost_hour', $person_id) }}"
                class="@if ($active == 'cost_hour') active @endif nav-link">Precio coste/hora</a></li>
    </ul>

</div>
