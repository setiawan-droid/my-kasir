<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Data produk (simulasi database)
     */
    private array $products = [
        ['id' => 1, 'name' => 'Laptop Gaming X'],
        ['id' => 2, 'name' => 'Mouse Wireless'],
        ['id' => 3, 'name' => 'Keyboard Mekanikal'],
        ['id' => 4, 'name' => 'Monitor 4K'],
        ['id' => 5, 'name' => 'Webcam HD'],
    ];

    public function index(): View
    {
        return view('search.index', [
            'products' => $this->products,
            'result' => null,
            'search_query' => '',
            'steps_taken' => null,
            'algorithm' => '',
            'best_case' => null,
            'worst_case' => null
        ]);
    }

    /**
     * Menjalankan pencarian sesuai algoritma
     */
    public function performSearch(Request $request): View
    {
        $searchQuery = strtolower($request->input('query'));
        $algorithm = $request->input('algorithm', 'sequential');

        if ($algorithm === 'binary') {
            $result = $this->binarySearch($searchQuery);
        } else {
            $result = $this->sequentialSearch($searchQuery);
        }

        return view('search.index', array_merge($result, [
            'products' => $this->products,
            'search_query' => $searchQuery,
            'algorithm' => $algorithm
        ]));
    }

    /**
     * Implementasi Sequential Search
     */
    private function sequentialSearch(string $query): array
    {
        $steps = 0;
        $found = null;

        foreach ($this->products as $product) {
            $steps++;

            if (str_contains(strtolower($product['name']), $query)) {
                $found = $product;
                break;
            }
        }

        $n = count($this->products);

        return [
            'result' => $found,
            'steps_taken' => $steps,
            'best_case' => "O(1) — ditemukan pada elemen pertama",
            'worst_case' => "O(n) atau O($n) — jika ditemukan terakhir atau tidak ditemukan"
        ];
    }

    /**
     * Implementasi Binary Search
     */
    private function binarySearch(string $query): array
    {
        // Sort data berdasarkan nama
        $sorted = $this->products;
        usort($sorted, fn($a, $b) => strcmp($a['name'], $b['name']));

        $left = 0;
        $right = count($sorted) - 1;
        $steps = 0;
        $found = null;

        while ($left <= $right) {
            $steps++;
            $mid = (int)(($left + $right) / 2);

            $midVal = strtolower($sorted[$mid]['name']);

            // Karena nama produk berupa strings cukup panjang, kita pakai str_contains
            if (str_contains($midVal, $query)) {
                $found = $sorted[$mid];
                break;
            }

            if ($query < $midVal) {
                $right = $mid - 1;
            } else {
                $left = $mid + 1;
            }
        }

        $n = count($this->products);

        return [
            'result' => $found,
            'steps_taken' => $steps,
            'best_case' => "O(1) — ketika langsung bertemu di midpoint pertama",
            'worst_case' => "O(log n) atau O(" . round(log($n, 2), 2) . ") — ketika harus membagi data berkali-kali"
        ];
    }
}
