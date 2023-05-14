<div>
    <img class="h-full w-full object-cover object-center" src="{{ Storage::url($product->image) }}" alt="" />

    <h3>{{ Str::limit($product->name) }}</h3>
    <P>{{ $product->description }}</P>
    <P>{{ $product->prix }}€</P>

    <a href="{{ route('addtocart', $product) }}">Ajouter au panier</a>

</div>

Autres Produits
<ul>
    @forelse ($products as $itemProduit)
        <li>
            <a href="{{ route('home.detail', $itemProduit) }}">
                {{ $itemProduit->name }}
            </a>
        </li>
    @empty
        Pas de produits à afficher
    @endforelse

</ul>
