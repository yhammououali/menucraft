<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecipeController extends AbstractController
{
    public function __construct(private RecipeRepository $recipeRepository)
    {
    }

    #[Route('/recipes', name: 'menucraft_recipe_list', methods: ['GET'])]
    public function list(): Response
    {
        //$recipes = $this->getRecipes();

        // return $this->json($recipes);

        return $this->render('recipe/list.html.twig', [
            //'recipes' => $this->recipeRepository->findAll(),
            'recipes' => $this->recipeRepository->findPublishedAndNotDeleted(),
        ]);
    }

    #[Route('/recipes/create', name: 'menucraft_recipe_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recipe = new Recipe();

        $form = $this->createForm(RecipeType::class, $recipe);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setIsPublished(false);

            $entityManager->persist($recipe);
            $entityManager->flush();

            return $this->redirectToRoute('menucraft_recipe_list');
        }

        return $this->render('recipe/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/recipes/{id}', name: 'menucraft_recipe_read', methods: ['GET'])]
    public function read(Recipe $recipe): Response
    {
        //$recipes = $this->getRecipes();
        //$recipe = array_filter($recipes, fn($recipe) => $recipe['id'] === $id);

        if (empty($recipe)) {
            return $this->json(['message' => 'Recipe not found'], 404);
        }

        // return $this->json(array_values($recipe)[0]);
        return $this->render('recipe/show.html.twig', [
            //'recipe' => array_values($recipe)[0]
            'recipe' => $recipe
        ]);
    }

    #[Route('/recipes/{id}/update', name: 'menucraft_recipe_update', methods: ['GET', 'POST'])]
    public function edit(Request $request, Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe, ['is_edit' => true]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('menucraft_recipe_list');
        }

        return $this->render('recipe/edit.html.twig', [
            'form' => $form->createView(),
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recipes/delete/{id}', name: 'menucraft_recipe_delete', methods: ['GET'])]
    public function delete(Recipe $recipe, EntityManagerInterface $entityManager): Response
    {
        // Hard delete
        //$recipe->setDeletedAt(new \DateTimeImmutable());

        $recipe->setDeletedAt(new \DateTimeImmutable());
        $entityManager->flush();

        return $this->redirectToRoute('menucraft_recipe_list');
    }

    private function getRecipes(): array
    {
        return [
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
    }
}
