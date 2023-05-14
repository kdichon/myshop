Catégories
<ul>
    @forelse ($categories as $itemCategory)
        <li>
            <a href="{{ route('home.category', $itemCategory) }}">
                {{ $itemCategory->name }}
            </a>
        </li>
    @empty
        Pas de catégories à afficher
    @endforelse
</ul>

<br>

Produits
<ul>
    @forelse ($products as $itemProduct)
        <li>
            <a href="{{ route('home.detail', $itemProduct) }}">
                {{ $itemProduct->name }}
            </a>
        </li>
    @empty
        Pas de produits à afficher
    @endforelse

</ul>

@livewireScripts()
</body>

</html>
