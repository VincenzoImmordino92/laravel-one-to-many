<aside class="bg-dark">
    <nav>
        <ul>
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="{{Route::currentRouteName() === 'admin.home' ? 'active' : ''}}"><i class="fa-solid fa-table-columns"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.projects.index')}}" class="{{Route::currentRouteName() === 'admin.projects.index' ? 'active' : ''}}"><i class="fa-solid fa-table-list"></i>Elenco Project</a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.projects.create')}}" class="{{Route::currentRouteName() === 'admin.projects.create' ? 'active' : ''}}"><i class="fa-solid fa-folder-plus"></i>Aggiungi Project</a>
            </li>
            <li class="nav-item">
                <a  href="{{route('admin.technologies.index')}}" class="{{Route::currentRouteName() === 'admin.technologies.index' ? 'active' : ''}}"><i class="fa-solid fa-chalkboard"></i>Elenco Tecnologie</a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.types.index')}}" class="{{Route::currentRouteName() === 'admin.types.index' ? 'active' : ''}}"><i class="fa-solid fa-keyboard"></i>Elenco Tipo</a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.type-project')}}" class="{{Route::currentRouteName() === 'admin.types.index' ? 'active' : ''}}"><i class="fa-solid fa-list"></i>Elenco Progetti per Tipo</a>
            </li>
        </ul>
    </nav>
</aside>
