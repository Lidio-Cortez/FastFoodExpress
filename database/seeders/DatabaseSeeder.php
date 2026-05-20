<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Hambúrgueres', 'slug' => 'hamburgueres'],
            ['name' => 'Pizzas',        'slug' => 'pizzas'],
            ['name' => 'Acompanhamentos','slug' => 'acompanhamentos'],
            ['name' => 'Bebidas',       'slug' => 'bebidas'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $hamburgueres = Category::where('slug', 'hamburgueres')->first();
        $pizzas       = Category::where('slug', 'pizzas')->first();
        $acomp        = Category::where('slug', 'acompanhamentos')->first();
        $bebidas      = Category::where('slug', 'bebidas')->first();

        $products = [
            // Hambúrgueres
            ['category_id' => $hamburgueres->id, 'name' => 'Burger Clássico',  'description' => 'Hambúrguer suculento com queijo, alface, tomate e molho especial', 'price' => 8.99,  'image' => 'burger-classico.jpg'],
            ['category_id' => $hamburgueres->id, 'name' => 'Burger Deluxe',    'description' => 'Duplo hambúrguer com bacon crocante, queijo cheddar e cebola caramelizada', 'price' => 11.99, 'image' => 'burger-deluxe.jpg'],
            ['category_id' => $hamburgueres->id, 'name' => 'Burger Vegano',    'description' => 'Hambúrguer vegetal com guacamole, alface roxa e molho agridoce', 'price' => 9.49,  'image' => 'burger-vegano.jpg'],
            ['category_id' => $hamburgueres->id, 'name' => 'Burger Spicy',     'description' => 'Hambúrguer picante com jalapeños, pimenta vermelha e aioli', 'price' => 10.49, 'image' => 'burger-spicy.jpg'],

            // Pizzas
            ['category_id' => $pizzas->id, 'name' => 'Pizza Pepperoni',  'description' => 'Pizza tradicional com muito pepperoni e queijo mozzarella derretido', 'price' => 12.99, 'image' => 'pizza-pepperoni.jpg'],
            ['category_id' => $pizzas->id, 'name' => 'Pizza Margherita', 'description' => 'Clássica italiana com molho de tomate, mozzarella e manjericão fresco', 'price' => 11.49, 'image' => 'pizza-margherita.jpg'],
            ['category_id' => $pizzas->id, 'name' => 'Pizza 4 Queijos',  'description' => 'Mozzarella, gorgonzola, parmesão e queijo da ilha', 'price' => 13.49, 'image' => 'pizza-4queijos.jpg'],

            // Acompanhamentos
            ['category_id' => $acomp->id, 'name' => 'Batatas Fritas',   'description' => 'Batatas douradas e crocantes com sal e especiarias', 'price' => 3.49, 'image' => 'batatas.jpg'],
            ['category_id' => $acomp->id, 'name' => 'Onion Rings',      'description' => 'Anéis de cebola panados e fritos, crocantes por fora', 'price' => 4.29, 'image' => 'onion-rings.jpg'],
            ['category_id' => $acomp->id, 'name' => 'Nuggets de Frango','description' => '8 nuggets de frango crocantes com molho à escolha', 'price' => 5.99, 'image' => 'nuggets.jpg'],

            // Bebidas
            ['category_id' => $bebidas->id, 'name' => 'Refrigerante',   'description' => 'Coca-Cola, Pepsi, Sprite ou Fanta (0.33L)', 'price' => 2.49, 'image' => 'refrigerante.jpg'],
            ['category_id' => $bebidas->id, 'name' => 'Sumo Natural',   'description' => 'Laranja, maçã ou manga espremidos na hora', 'price' => 3.99, 'image' => 'sumo.jpg'],
            ['category_id' => $bebidas->id, 'name' => 'Milkshake',      'description' => 'Baunilha, chocolate ou morango — cremoso e gelado', 'price' => 4.99, 'image' => 'milkshake.jpg'],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }
    }
}
