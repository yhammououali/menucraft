<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    #[Route('/recipes', name: 'menucraft_recipe_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $recipes = [
            [
                'id' => 1,
                'name' => 'Pasta al Pesto',
                'preparationTime' => 20,
                'difficulty' => 'easy',
                'steps' => '1. Cook pasta. 2. Mix with pesto sauce.',
                'ingredients' => [
                    [
                        'id' => 1,
                        'name' => 'Pasta',
                        'quantity' => 200,
                        'unit' => 'g',
                    ],
                    [
                        'id' => 2,
                        'name' => 'Pesto sauce',
                        'quantity' => 100,
                        'unit' => 'ml',
                    ],
                ],
            ],
            [
                'id' => 2,
                'name' => 'Chicken Curry',
                'preparationTime' => 40,
                'difficulty' => 'medium',
                'steps' => '1. Sauté onions. 2. Add chicken and spices. 3. Simmer with coconut milk.',
                'ingredients' => [
                    [
                        'id' => 3,
                        'name' => 'Chicken',
                        'quantity' => 500,
                        'unit' => 'g',
                    ],
                    [
                        'id' => 4,
                        'name' => 'Coconut milk',
                        'quantity' => 250,
                        'unit' => 'ml',
                    ],
                    [
                        'id' => 5,
                        'name' => 'Curry powder',
                        'quantity' => 2,
                        'unit' => 'tbsp',
                    ],
                ],
            ],
            [
                'id' => 3,
                'name' => 'Vegetable Stir Fry',
                'preparationTime' => 15,
                'difficulty' => 'easy',
                'steps' => '1. Chop vegetables. 2. Stir fry in a hot pan with soy sauce.',
                'ingredients' => [
                    [
                        'id' => 6,
                        'name' => 'Carrots',
                        'quantity' => 100,
                        'unit' => 'g',
                    ],
                    [
                        'id' => 7,
                        'name' => 'Broccoli',
                        'quantity' => 150,
                        'unit' => 'g',
                    ],
                    [
                        'id' => 8,
                        'name' => 'Soy sauce',
                        'quantity' => 3,
                        'unit' => 'tbsp',
                    ],
                ],
            ],
        ];

        return $this->json($recipes);
    }
}
